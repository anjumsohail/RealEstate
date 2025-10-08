<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class MapSearch extends Component
{
    use WithPagination;

    public $latitude = 24.9480;
    public $longitude = 67.1541;
    public $radius = 10;
    public $geoData = []; // Initialize as empty array

    public $properties;
    public $MapData;
    public $searched = false;
    public $propertyCount = 0;
    public $geoCount = 0;
    //Filter Logic Variables
    public bool $filterCity = false;
    public bool $filterTown = false;
    public bool $filterSector = false;
    public bool $filterBlock = false;
    public bool $filterProperty = true;

    protected $queryString = ['page'];

    public function setCoordinates($latitude, $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;

        $this->dispatch('MapUpdated', [
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);
    }

    public function PageReset()
    {
        $this->latitude = 24.9480;
        $this->longitude = 67.1541;
        $this->radius = 10;
        $this->geoData = [];
        $this->properties = [];
        $this->propertyCount = 0;
        $this->searched = false;
        $this->resetPage();
    }

    public function search()
    {

        $rows = DB::select("CALL GetGeoHierarchy(?, ?, ?)", [
            $this->latitude,
            $this->longitude,
            $this->radius,
        ]);

        $this->geoData = collect($rows)->map(function ($row) {
            return [
                'level' => $row->level,
                'name'  => $row->name,
            ];
        })->values()->all();
        $this->geoCount = count($this->geoData);
        $results = DB::select($this->propertiesQuery(
            $this->filterCity,
            $this->filterTown,
            $this->filterSector,
            $this->filterBlock,
            $this->filterProperty
        ));

        $this->properties = \App\Models\PropertyAdvertisement::hydrate($results);
        $this->propertyCount = count($this->properties);

        $results = DB::select(
            "
            SELECT id,title,purpose,proptype,latitude,longitude FROM property_advertisements pa
            WHERE ST_Distance( ST_GeomFromText(CONCAT('POINT(', pa.longitude, ' ', pa.latitude, ')'), 4326),
                    ST_GeomFromText(CONCAT('POINT(', ?, ' ', ? ,')'), 4326) ) * 111.325 <= ?",
            [
                $this->longitude,  // first ? → your reference longitude
                $this->latitude,   // second ? → your reference latitude
                $this->radius      // third ? → search radius in kilometers
            ]
        );

        $this->MapData = \App\Models\PropertyAdvertisement::hydrate($results);
        // Emit to JS
        // ✅ Convert to simple array
        $payload = $this->MapData->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'purpose' => $item->purpose,
                'proptype' => $item->proptype,
                'latitude' => (float) $item->latitude,
                'longitude' => (float) $item->longitude,
            ];
        })->values()->toArray();

        // ✅ Dispatch clean array to frontend
        $this->dispatch('mapDataUpdated', $payload);
        $this->dispatch('mapDataUpdated', ...[$payload]);



        $this->searched = true;
        $this->resetPage();
    }

    // FIX: Change to regular method and call it explicitly
    public function getGeoDataPaginator()
    {
        $perPage = 15;
        $currentPage = request()->query('page', 1);

        if ($this->searched && !empty($this->geoData)) {
            $collection = collect($this->geoData);
            $items = $collection->slice(($currentPage - 1) * $perPage, $perPage)->values();
            $total = $collection->count();
        } else {
            $items = [];
            $total = 0;
        }

        return new LengthAwarePaginator(
            $items,
            $total,
            $perPage,
            $currentPage,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );
    }

    public function propertiesQuery(bool $filterCity = false, bool $filterTown = false, bool $filterSector = false, bool $filterBlock = false, bool $filterProperty = false)
    {
        $bufferRadius = $this->radius / 111.325;

        DB::statement("SET @latitude = ?", [$this->latitude]);
        DB::statement("SET @longitude = ?", [$this->longitude]);
        DB::statement("SET @in_radius_km = ?", [$this->radius]);
        DB::statement("SET @buffer_radius = ?", [$bufferRadius]);
        DB::statement("SET @point = ST_GeomFromText(CONCAT('POINT(', @longitude, ' ', @latitude, ')'), 4326)");

        // Start building WHERE clauses based on filters
        $conditions = [];

        // Only Properties
        if ($filterProperty) {
            $conditions[] = "
            ST_Distance(
                ST_GeomFromText(CONCAT('POINT(', pa.longitude, ' ', pa.latitude, ')'), 4326),
                @point
            ) * 111.325 <= @in_radius_km
        ";
        }

        // Town
        if ($filterTown) {
            $conditions[] = "
            pa.town_id IN (
                SELECT id FROM towns t
                WHERE (
                    MBRIntersects(t.geometry, ST_Buffer(@point, @buffer_radius))
                    AND ST_Distance(ST_Centroid(t.geometry), @point) * 111.325 < 5
                )
                OR ST_Contains(t.geometry, @point)
            )
        ";
        }

        // Sector
        if ($filterSector) {
            $conditions[] = "
            pa.sector_id IN (
                SELECT id FROM sectors s
                WHERE (
                    MBRIntersects(s.geometry, ST_Buffer(@point, @buffer_radius))
                    AND ST_Distance(ST_Centroid(s.geometry), @point) * 111.325 < 5
                )
                OR ST_Contains(s.geometry, @point)
            )
        ";
        }

        // Block
        if ($filterBlock) {
            $conditions[] = "
            pa.block_id IN (
                SELECT id FROM blocks b
                WHERE (
                    MBRIntersects(b.geometry, ST_Buffer(@point, @buffer_radius))
                    AND ST_Distance(ST_Centroid(b.geometry), @point) * 111.325 < 5
                )
                OR ST_Contains(b.geometry, @point)
            )
        ";
        }

        // City — if you later add city-level logic
        if ($filterCity) {
            $conditions[] = "
            pa.city_id IN (
                SELECT id FROM cities c
                WHERE (
                    MBRIntersects(c.geometry, ST_Buffer(@point, @buffer_radius))
                    AND ST_Distance(ST_Centroid(c.geometry), @point) * 111.325 < 5
                )
                OR ST_Contains(c.geometry, @point)
            )
        ";
        }

        // If no filters are selected, optionally return an empty query or all properties
        if (empty($conditions)) {
            return "SELECT id FROM property_advertisements WHERE 0"; // Return nothing
        }

        // Join all conditions using OR
        $whereClause = implode(" OR ", $conditions);

        $query = "
        SELECT id
        FROM property_advertisements pa
        WHERE $whereClause;
    ";

        return $query;
    }


    public function render()
    {
        // FIX: Call the method explicitly to get the Paginator object
        $geoDataPaginator = $this->getGeoDataPaginator();

        return view('livewire.map-search', [
            'geoData' => $geoDataPaginator, // This is now DEFINITELY a Paginator object
            'geoCount' => $this->geoCount,
            'MapData' => $this->MapData,
            'properties' => $this->properties,
            'propertyCount' => $this->propertyCount,
        ]);
    }
}

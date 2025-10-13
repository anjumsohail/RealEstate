<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PropertyAdvertisement;
use Illuminate\Database\Eloquent\Builder;


class MapSearch extends Component
{
    use WithPagination;

    public $latitude = 24.9480;
    public $longitude = 67.1541;
    public $radius = 10;
    public $geoData = []; // Initialize as empty array
    public $listData = [];
    public $MapData;
    public $searched = false;
    public $senderComponent = "Map";
    public $geoCount = 0;
    //Filter Logic Variables
    public bool $filterCity = false;
    public bool $filterTown = false;
    public bool $filterSector = false;
    public bool $filterBlock = false;
    public bool $filterProperty = true;

    protected $queryString = ['page'];



    public function search()
    {
        $this->fetchGeoHierarchy();
        $this->fetchMapData();
        $this->dispatchMapData();

        $this->searched = true;

        $this->fetchListData();
        $this->dispatchListData();

        $this->resetPage();
    }

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
        $this->searched = false;
        $this->resetPage();

        $this->listData = [];
        $this->dispatch('performSearch', [
            'senderComponent' => $this->senderComponent,
            'searched' => $this->searched,
            'listData' => $this->listData,
        ])->to('property-list'); // <- component name
    }

    private function fetchGeoHierarchy()
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
    }

    private function fetchMapData()
    {
        $results = DB::select(
            "
        SELECT id, title, purpose, proptype, latitude, longitude
        FROM property_advertisements pa
        WHERE ST_Distance(
            ST_GeomFromText(CONCAT('POINT(', pa.longitude, ' ', pa.latitude, ')'), 4326),
            ST_GeomFromText(CONCAT('POINT(', ?, ' ', ? ,')'), 4326)
        ) * 111.325 <= ?
        ",
            [
                $this->longitude,
                $this->latitude,
                $this->radius,
            ]
        );

        $this->MapData = \App\Models\PropertyAdvertisement::hydrate($results);
    }

    private function dispatchMapData()
    {
        $payload = $this->MapData->map(function ($item) {
            return [
                'id'        => $item->id,
                'title'     => $item->title,
                'purpose'   => $item->purpose,
                'proptype'  => $item->proptype,
                'latitude'  => (float) $item->latitude,
                'longitude' => (float) $item->longitude,
            ];
        })->values()->toArray();

        $this->dispatch('mapDataUpdated', $payload);
    }

    private function fetchListData()
    {
        $query = $this->propertiesQuery(
            $this->filterCity,
            $this->filterTown,
            $this->filterSector,
            $this->filterBlock,
            $this->filterProperty,
            $this->latitude,
            $this->longitude,
            $this->radius
        );

        $this->listData = $query->pluck('id')->toArray();
    }

    private function dispatchListData()
    {
        $this->dispatch('performSearch', [
            'senderComponent' => $this->senderComponent,
            'searched' => $this->searched,
            'listData' => $this->listData,
        ])->to('property-list');
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


    public function propertiesQuery(
        bool $filterCity = false,
        bool $filterTown = false,
        bool $filterSector = false,
        bool $filterBlock = false,
        bool $filterProperty = false,
        $latitude,
        $longitude,
        $radius
    ): Builder {
        $query = PropertyAdvertisement::query();

        $bufferRadius = $radius / 111.325;
        $lat = $latitude;
        $lng = $longitude;
        $point = "ST_GeomFromText('POINT($lng $lat)', 4326)";

        // If no filters selected or not searched, return no results
        if (
            (
                !$filterCity &&
                !$filterTown &&
                !$filterSector &&
                !$filterBlock &&
                !$filterProperty
            ) || !$this->searched
        ) {
            $query->whereRaw('0 = 1');
            return $query->select('id');
        }

        // Wrap all filters in a where() group with orWhere() logic
        $query->where(function ($q) use (
            $filterCity,
            $filterTown,
            $filterSector,
            $filterBlock,
            $filterProperty,
            $point,
            $bufferRadius,
            $radius
        ) {
            // Nearby property filter
            if ($filterProperty) {
                $q->orWhereRaw("
                ST_Distance(
                    ST_GeomFromText(CONCAT('POINT(', longitude, ' ', latitude, ')'), 4326),
                    $point
                ) * 111.325 <= ?
            ", [$radius]);
            }

            // City filter
            if ($filterCity) {
                $q->orWhereIn('city_id', function ($sub) use ($point, $bufferRadius) {
                    $sub->select('id')->from('cities')
                        ->whereRaw("(
                        (MBRIntersects(geometry, ST_Buffer($point, ?)) AND
                        ST_Distance(ST_Centroid(geometry), $point) * 111.325 < 5)
                        OR ST_Contains(geometry, $point)
                    )", [$bufferRadius]);
                });
            }

            // Town filter
            if ($filterTown) {
                $q->orWhereIn('town_id', function ($sub) use ($point, $bufferRadius) {
                    $sub->select('id')->from('towns')
                        ->whereRaw("(
                        (MBRIntersects(geometry, ST_Buffer($point, ?)) AND
                        ST_Distance(ST_Centroid(geometry), $point) * 111.325 < 5)
                        OR ST_Contains(geometry, $point)
                    )", [$bufferRadius]);
                });
            }

            // Sector filter
            if ($filterSector) {
                $q->orWhereIn('sector_id', function ($sub) use ($point, $bufferRadius) {
                    $sub->select('id')->from('sectors')
                        ->whereRaw("(
                        (MBRIntersects(geometry, ST_Buffer($point, ?)) AND
                        ST_Distance(ST_Centroid(geometry), $point) * 111.325 < 5)
                        OR ST_Contains(geometry, $point)
                    )", [$bufferRadius]);
                });
            }

            // Block filter
            if ($filterBlock) {
                $q->orWhereIn('block_id', function ($sub) use ($point, $bufferRadius) {
                    $sub->select('id')->from('blocks')
                        ->whereRaw("(
                        (MBRIntersects(geometry, ST_Buffer($point, ?)) AND
                        ST_Distance(ST_Centroid(geometry), $point) * 111.325 < 5)
                        OR ST_Contains(geometry, $point)
                    )", [$bufferRadius]);
                });
            }
        });

        return $query->select('id');
    }

    protected $listeners = ['showPropertyDetail'];
    public function render()
    {
        // FIX: Call the method explicitly to get the Paginator object
        $geoDataPaginator = $this->getGeoDataPaginator();

        return view('livewire.map-search', [
            'geoData' => $geoDataPaginator, // This is now DEFINITELY a Paginator object
            'geoCount' => $this->geoCount,
            'MapData' => $this->MapData,
        ]);
    }
}

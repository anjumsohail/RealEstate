<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use App\Models\PropertyAdvertisement;
use Livewire\WithPagination;


class PropertyList extends Component
{
    use WithPagination;

    public $filterCity, $filterTown, $filterSector, $filterBlock, $filterProperty;
    public $latitude, $longitude, $radius;
    public $senderComponent;
    public bool $searched = false;

    protected $listeners = ['performSearch'];


    // This runs when component is instantiated
    public function performSearch($filters)
    {
        $this->senderComponent = $filters['senderComponent'];
        $this->searched = $filters['searched'];
        $this->filterCity = $filters['filterCity'];
        $this->filterTown = $filters['filterTown'];
        $this->filterSector = $filters['filterSector'];
        $this->filterBlock = $filters['filterBlock'];
        $this->filterProperty = $filters['filterProperty'];
        $this->latitude = $filters['latitude'];
        $this->longitude = $filters['longitude'];
        $this->radius = $filters['radius'];

        $this->resetPage(); // reset pagination
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
        $radius = $radius;

        //$point = DB::raw("ST_GeomFromText('POINT($lng $lat)', 4326)");
        $point = "ST_GeomFromText('POINT($lng $lat)', 4326)";

        // Property filter: Nearby properties
        if ($filterProperty) {
            $query->whereRaw("
            ST_Distance(
                ST_GeomFromText(CONCAT('POINT(', longitude, ' ', latitude, ')'), 4326),
                $point
            ) * 111.325 <= ?
        ", [$radius]);
        }

        // City filter
        if ($filterCity) {
            $query->whereIn('city_id', function ($sub) use ($point, $bufferRadius) {
                $sub->select('id')->from('cities')
                    ->whereRaw("(
                    MBRIntersects(geometry, ST_Buffer($point, ?)) AND
                    ST_Distance(ST_Centroid(geometry), $point) * 111.325 < 5
                ) OR ST_Contains(geometry, $point)", [$bufferRadius]);
            });
        }

        // Town filter
        if ($filterTown) {
            $query->whereIn('town_id', function ($sub) use ($point, $bufferRadius) {
                $sub->select('id')->from('towns')
                    ->whereRaw("(
                    MBRIntersects(geometry, ST_Buffer($point, ?)) AND
                    ST_Distance(ST_Centroid(geometry), $point) * 111.325 < 5
                ) OR ST_Contains(geometry, $point)", [$bufferRadius]);
            });
        }

        // Sector filter
        if ($filterSector) {
            $query->whereIn('sector_id', function ($sub) use ($point, $bufferRadius) {
                $sub->select('id')->from('sectors')
                    ->whereRaw("(
                    MBRIntersects(geometry, ST_Buffer($point, ?)) AND
                    ST_Distance(ST_Centroid(geometry), $point) * 111.325 < 5
                ) OR ST_Contains(geometry, $point)", [$bufferRadius]);
            });
        }

        // Block filter
        if ($filterBlock) {
            $query->whereIn('block_id', function ($sub) use ($point, $bufferRadius) {
                $sub->select('id')->from('blocks')
                    ->whereRaw("(
                    MBRIntersects(geometry, ST_Buffer($point, ?)) AND
                    ST_Distance(ST_Centroid(geometry), $point) * 111.325 < 5
                ) OR ST_Contains(geometry, $point)", [$bufferRadius]);
            });
        }

        // If no filters selected, return empty query (match nothing)
        if (
            (
                !$filterCity &&
                !$filterTown &&
                !$filterSector &&
                !$filterBlock &&
                !$filterProperty
            ) || !$this->searched
        ) {
            $query->whereRaw('0 = 1'); // Always false — returns no results
        }

        return $query;
    }



    public function render()
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

        $properties = $query->paginate(15);

        return view('livewire.property-list', [
            'properties' => $properties,
            'propertyCount' => $properties->total(),
        ]);
    }
}

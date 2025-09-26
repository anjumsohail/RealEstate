<?php

namespace App\Livewire;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Collection;

class MapSearch extends Component
{
     use WithPagination;

    public $latitude = 24.9480;
    public $longitude = 67.1541;
    public $radius = 10;
    public $results = [];
    public $searched = false;

    public function setCoordinates($latitude, $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;

        
        // 🚀 Notify parent (PropertyAdd) component
        $this->dispatch('MapUpdated', [
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);
    }

       // keep page in query string (optional)
    protected $queryString = ['page'];

        public function PageReset()
    {
        $this->latitude = 24.9480;
        $this->longitude = 67.1541;
        $this->radius = 10;
        $this->results = [];
        $this->searched = false;
        $this->resetPage(); // reset to page 1
    }

        public function search()
    {
        $rows = DB::select("CALL GetGeoHierarchy(?, ?, ?)", [
            $this->latitude,
            $this->longitude,
            $this->radius,
        ]);

        // convert to array for Livewire-friendly serialization
        $this->results = collect($rows)->map(function ($row) {
            return [
                'level' => $row->level,
                'name'  => $row->name,
            ];
        })->values()->all();

        $this->searched = true;
        $this->resetPage(); // reset to page 1 after a new search
    }

    // computed property that returns a LengthAwarePaginator
    public function getPaginatedResultsProperty()
    {
        $perPage = 15; // 5 rows × 3 pairs

        // Use the paginator static resolver to get current page (works with Livewire requests)
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        $collection = collect($this->results);

        $items = $collection
            ->slice(($currentPage - 1) * $perPage, $perPage)
            ->values();

        return new LengthAwarePaginator(
            $items,
            $collection->count(),
            $perPage,
            $currentPage,
            [
                'path'  => request()->url(),
                'query' => request()->query(),
            ]
        );
    }

    
    public function render()
    {        
            // build an empty paginator so view can always call ->links()
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $emptyPaginator = new LengthAwarePaginator([], 0, 15, $currentPage, [
            'path'  => request()->url(),
            'query' => request()->query(),
        ]);

        return view('livewire.map-search', [
            'geoData' => $this->searched ? $this->paginatedResults : $emptyPaginator,
        ]);
    
    }
}



<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use App\Models\PropertyAdvertisement;
use Livewire\WithPagination;


class PropertyList extends Component
{
    use WithPagination;

    public $senderComponent;
    public $listData=[];
    public bool $searched = false;

    protected $listeners = ['performSearch'];


    // This runs when component is instantiated
    public function performSearch($filters)
    {
        $this->senderComponent = $filters['senderComponent'];
        $this->searched = $filters['searched'];
        $this->listData = $filters['listData'];

        $this->resetPage(); // reset pagination
    }


    public function render()
    {

        $properties = PropertyAdvertisement::whereIn('id', $this->listData)->paginate(4); // Or re-query as needed
        return view('livewire.property-list', [
            'properties' => $properties,
            'propertyCount' => $properties->total(),
        ]);
    }
}

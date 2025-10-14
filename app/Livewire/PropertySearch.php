<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\PropertyAdvertisement;
use Illuminate\Database\Eloquent\Builder;

class PropertySearch extends Component
{
    public $city_id;
    public $town_id;
    public $sector_id;
    public $block_id;
    public $proptype;
    public $propfor;
    public $listData = [];


    #[On('geographySelected')]
    public function geographySelected($CityParams)
    {

        $this->city_id = $CityParams['city_id'];
        $this->town_id = $CityParams['town_id'];
        $this->sector_id = $CityParams['sector_id'];
        $this->block_id = $CityParams['block_id'];
    }


    public function propertiesQuery(): Builder
    {
        $query = PropertyAdvertisement::query();
        if ($this->proptype)   $query->where('proptype', $this->proptype);
        if ($this->propfor)   $query->where('purpose', $this->propfor);
        if ($this->city_id)   $query->where('city_id', $this->city_id);
        if ($this->town_id)   $query->where('town_id', $this->town_id);
        if ($this->sector_id) $query->where('sector_id', $this->sector_id);
        if ($this->block_id)  $query->where('block_id', $this->block_id);
        //dd($query->toSql());
        return $query->select('id');
    }

    public function search()
    {


        $query = $this->propertiesQuery();
        $this->listData = $query->pluck('id')->toArray();

        if (count($this->listData) > 0) {

            $this->dispatch('performSearch', [
                'senderComponent' => 'PropertySearch',
                'searched' => true,
                'listData' => $this->listData,
            ])->to('property-list'); // <- component name
        }
    }
    public function render()
    {
        return view('livewire.property-search');
    }
}

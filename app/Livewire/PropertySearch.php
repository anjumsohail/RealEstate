<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\City;
use App\Models\Town;
use App\Models\Sector;
use App\Models\Block;
use App\Models\PropertyAdvertisement;
use Illuminate\Support\Facades\Log;


class PropertySearch extends Component
{
    public $selectedCity = null;
    public $selectedTown = null;
    public $selectedSector = null;
    public $selectedBlock = null;

    public $cities = [];
    public $towns = [];
    public $sectors = [];
    public $blocks = [];

    public $properties = [];

    public function mount()
    {
        // Load cities at the start
        $this->cities = City::orderBy('name')->get();
    }

    public function updatedSelectedCity($value)
    {    
        //$this->dispatch('log', ['message' => 'City updated: '.$value]);
         $this->dispatch('log', message: "City changed to ID $value");

        $this->towns = Town::where('city_id', $value)->get();
        $this->selectedTown = null;
        $this->sectors = [];
        $this->selectedSector = null;
        $this->blocks = [];
        $this->selectedBlock = null;
    }

    public function updatedSelectedTown($value)
    {
        $this->sectors = Sector::where('town_id', $value)->orderBy('name')->get();
        $this->selectedSector = $this->selectedBlock = null;
        $this->blocks = [];
    }

    public function updatedSelectedSector($value)
    { 
        $this->blocks = Block::where('sector_id', $value)->orderBy('name')->get();
        $this->selectedBlock = null;
    }

    public function search()
    {
        $query = PropertyAdvertisement::query();

        if ($this->cityid)   $query->where('city_id', $this->cityid);
        if ($this->townid)   $query->where('town_id', $this->townid);
        if ($this->sectorid) $query->where('sector_id', $this->sectorid);
        if ($this->blockid)  $query->where('block_id', $this->blockid);

        $this->properties = $query->latest()->get();
    }

    public function render()
    {
        return view('livewire.property-search');
    }
}

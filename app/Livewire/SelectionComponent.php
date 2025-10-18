<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\City;
use App\Models\Town;
use App\Models\Sector;
use App\Models\Block;
use App\Models\PropertyAdvertisement;
use Illuminate\Support\Facades\Log;

class SelectionComponent extends Component
{
    public $columnClass = 'col-md-10';

    public $selectedCity = null;
    public $selectedTown = null;
    public $selectedSector = null;
    public $selectedBlock = null;

    public $cities = [];
    public $towns = [];
    public $sectors = [];
    public $blocks = [];

    public $properties = [];

    public function mount($mode = '', $cityid = '', $townid = '', $sectorid = '', $blockid = '')
    {
        // Load cities at the start
        $this->cities = City::orderBy('name')->get();
        if ($mode == 'edit') {
            $this->selectedCity = $cityid;
            $this->updatedSelectedCity($cityid);
            $this->selectedTown = $townid;
            $this->updatedSelectedTown($townid);
            $this->selectedSector = $sectorid;
            $this->updatedSelectedSector($sectorid);
            $this->selectedBlock = $blockid;
        }
    }

    public function updatedSelectedCity($value)
    {
        //$this->dispatch('log', ['message' => 'City updated: '.$value]);
        // $this->dispatch('log', message: "City changed to ID $value");

        $this->towns = Town::where('city_id', $value)->get();
        $this->selectedTown = null;
        $this->sectors = [];
        $this->selectedSector = null;
        $this->blocks = [];
        $this->selectedBlock = null;


        $this->dispatch('geographySelected', [
            'city_id' => $value,
            'town_id' => $this->selectedTown,
            'sector_id' => $this->selectedSector,
            'block_id' => $this->selectedBlock
        ]);
    }

    public function updatedSelectedTown($value)
    {
        $this->sectors = Sector::where('town_id', $value)->orderBy('name')->get();
        $this->selectedSector = $this->selectedBlock = null;
        $this->blocks = [];

        $this->dispatch('geographySelected', [
            'town_id' => $value,
            'city_id' => $this->selectedCity,
            'sector_id' => $this->selectedSector,
            'block_id' => $this->selectedBlock
        ]);
    }

    public function updatedSelectedSector($value)
    {
        $this->blocks = Block::where('sector_id', $value)->orderBy('name')->get();
        $this->selectedBlock = null;

        $this->dispatch('geographySelected', [
            'city_id' => $this->selectedCity,
            'town_id' => $this->selectedTown,
            'sector_id' => $value,
            'block_id' => $this->selectedBlock
        ]);
    }

    public function updatedSelectedBlock($value)
    {
        $this->selectedBlock = $value; // update immediately

        //$this->dispatch('log', message: "Block ID changed to ID $value");

        $this->dispatch('geographySelected', [
            'city_id'   => $this->selectedCity,
            'town_id'   => $this->selectedTown,
            'sector_id' => $this->selectedSector,
            'block_id'  => $value,   // use $value directly
        ]);
    }

    public function search()
    {
        $query = PropertyAdvertisement::query();

        if ($this->selectedCity)   $query->where('city_id', $this->selectedCity);
        if ($this->selectedTown)   $query->where('town_id', $this->selectedTown);
        if ($this->selectedSector) $query->where('sector_id', $this->selectedSector);
        if ($this->selectedBlock)  $query->where('block_id', $this->selectedBlock);

        $this->properties = $query->latest()->get();
    }

    public function render()
    {
        return view('livewire.selection-component');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;

class MapPicker extends Component
{
    public $latitude;
    public $longitude;

    public function mount($latitude = '', $longitude = '')
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

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

    public function render()
    {
        return view('livewire.map-picker');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;

class MapPicker extends Component
{
    public $latitude = 24.9480;
    public $longitude = 67.1541;

    public function mount($latitude = '24.9480', $longitude = '67.1541')
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

<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PropertyAdvertisement;

class PropertyDetail extends Component
{
    public $property;
    public $showModal = false;

    protected $listeners = ['showPropertyDetail', 'closePropertyDetail'];

    public function showPropertyDetail($propertyId)
    {
        $this->property = PropertyAdvertisement::with('pictures', 'city', 'town', 'sector', 'block')->find($propertyId);
        $this->showModal = true;
        // Dispatch with property data payload
        $this->dispatch('modal-opened', [
            'MapData' => [
                'lat' => $this->property->latitude, // Adjust field names as needed
                'long' => $this->property->longitude,
                'radius' => 0,
                'title' => $this->property->title
            ]
        ]);

        $this->js('window.dispatchEvent(new CustomEvent("modal-opened"))');
    }

    public function closePropertyDetail()
    {
        $this->showModal = false;
        $this->property = null;

        // Reset URL back to search
        $this->dispatch('reset-url');
        $this->dispatch('modal-closed'); // Add this

    }

    public function render()
    {
        return view('livewire.property-detail');
    }
}

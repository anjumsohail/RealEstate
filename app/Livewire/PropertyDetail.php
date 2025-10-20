<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PropertyAdvertisement;

class PropertyDetail extends Component
{

    public ?PropertyAdvertisement $property = null;
    public $showModal = false;
    public function mount($id = null)
    {
        if ($id) {
            $this->property = PropertyAdvertisement::with('pictures', 'city', 'town', 'sector', 'block')->find($id);
            $this->showModal = true;
        }
    }

    protected $listeners = ['showPropertyDetail', 'closePropertyDetail'];

    public function showPropertyDetail($propertyId)
    {
        // Avoid redundant queries
        if ($this->property && $this->property->id === (int) $propertyId) {
            $this->showModal = true;
            return;
        }

        $this->property = PropertyAdvertisement::with('pictures', 'city', 'town', 'sector', 'block')
            ->find($propertyId);

        $this->showModal = true;

        $this->dispatch('modal-opened', [
            'MapData' => [
                'lat' => $this->property->latitude,
                'long' => $this->property->longitude,
                'radius' => 0,
                'title' => $this->property->title
            ]
        ]);

        // Update browser URL without reloading
        $this->js("
        window.history.pushState({}, '', '/property/{$propertyId}');
        window.dispatchEvent(new CustomEvent('modal-opened'));
    ");
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

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
        $this->property = PropertyAdvertisement::with('pictures')->find($propertyId);
        $this->showModal = true;

        $this->dispatch('modal-opened'); // Add this
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

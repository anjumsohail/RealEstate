<?php

namespace App\Livewire;

use App\Models\PropertyAdvertisement;
use Livewire\Component;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PropertyItem extends Component
{
    public $propertyid;
    public ?PropertyAdvertisement $property;
    public $PicturesCount = 0;

    public function mount($propertyid)
    {
        $this->propertyid = $propertyid;
        try {
            $this->property = PropertyAdvertisement::with('pictures')
                ->withCount('pictures')
                ->findOrFail($this->propertyid);
            $this->PicturesCount = $this->property->pictures_count;
        } catch (ModelNotFoundException $e) {
            // Handle gracefully
            $this->property =  null;
            $this->PicturesCount = 0;
        }
    }

    public function showDetail()
    {
        // Emit event to parent components and PropertyDetail component
        $this->dispatch('showPropertyDetail', propertyId: $this->property->id);
    }

    public function render()
    {
        return view('livewire.property-item');
    }
}

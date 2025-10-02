<?php
namespace App\Livewire;
use Livewire\Component;

class PropertyList extends Component
{
    public $propertyCount;
    public $properties = [];


    // This runs when component is instantiated
    public function mount($propertyCount = 0, $properties = [])
    {
        $this->propertyCount = $propertyCount;
        $this->properties = $properties;
    } 
   

    public function render()
    {
        return view('livewire.property-list');
    }
}
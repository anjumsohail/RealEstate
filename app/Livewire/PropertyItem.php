<?php

namespace App\Livewire;

use Livewire\Component;

class PropertyItem extends Component
{
    public $propType="1";

    public function mount($propType)
    {
        $this->propType=$propType;
    }

    public function render()
    {
        return view('livewire.property-item');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PropertyPicture;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class ShowPhotos extends Component
{
    public $propertyId;
    public Collection $propertyPictures;
    public $deleteId = null;

    public function mount($propertyId = '')
    {
        $this->propertyId = $propertyId;

        $this->propertyPictures = collect();
        if ($this->propertyId) {
            $this->propertyPictures = PropertyPicture::where('property_advertisement_id', $this->propertyId)->get();
        }
    }

    public function setDeleteId($id)
    {
        $this->deleteId = $id;
    }

    public function confirmRemove()
    {
        if ($this->deleteId) {
            $this->removePicture($this->deleteId);
            $this->deleteId = null;
        }
    }

    public function removePicture($id)
    {
        // Find the picture directly from the existing collection
        $picture = $this->propertyPictures->firstWhere('id', $id);

        if ($picture) {
            // Delete file if it exists in storage
            if ($picture->image_path && Storage::exists(trim($picture->image_path))) {
                Storage::delete(trim($picture->image_path));
            }

            // Delete from DB
            PropertyPicture::where('id', $id)->delete();

            // Remove from in-memory collection
            $this->propertyPictures = $this->propertyPictures->reject(fn($p) => $p->id === $id)->values();

            // Trigger Livewire re-render automatically
            session()->flash('success', 'Picture removed successfully!');
        }
    }

    public function render()
    {
        return view('livewire.show-photos');
    }
}

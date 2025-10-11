<?php

namespace App\Livewire;

use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\PropertyPicture;

class PropertyImages extends Component
{
    use WithFileUploads;

    public $pictures = [];
    public $picture_titles = [];

    // 🔹 Listener for save
    protected $listeners = ['savePictures'];

    public function savePictures($propertyId)
    {
        try {
            // ✅ Validate pictures
            $this->validate([
                'pictures.*' => 'required|image|max:5120',
                'picture_titles.*' => 'nullable|string|max:255',
            ]);


            foreach ($this->pictures as $index => $file) {
                if (!$file) {
                    throw new \Exception("File at index {$index} is empty.");
                }

                // ✅ Try storing file
                $path = $file->store('property_images', 'public');
                if (!$path) {
                    throw new \Exception("Failed to store picture #{$index}");
                }

                // Delete temp file safely
                if (method_exists($file, 'getRealPath') && file_exists($file->getRealPath())) {
                    @unlink($file->getRealPath());
                }

                // ✅ Insert DB record
                PropertyPicture::create([
                    'property_advertisement_id' => $propertyId,
                    'image_path' => $path,
                    'title' => $this->picture_titles[$index] ?? null,
                ]);
            }

            // ✅ Reset fields after success
            $this->pictures = [];
            $this->picture_titles = [];

            logger()->info("Child savePictures success", ['propertyId' => $propertyId]);
            $this->dispatch('picturesStatus', status: 'success', message: 'Child savePictures success');
        } catch (\Throwable $e) {
            logger()->error("Child savePictures failed", ['error' => $e->getMessage()]);
            $this->reset(['pictures', 'picture_titles']);

            // Dispatch event BEFORE returning
            $this->dispatch('picturesStatus', status: 'error', message: $e->getMessage());

            // ✅ Return instead of throw to prevent Livewire’s render bug
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function removePicture($index)
    {
        unset($this->pictures[$index], $this->picture_titles[$index]);
        $this->pictures = array_values($this->pictures);
        $this->picture_titles = array_values($this->picture_titles);

        $this->dispatch('picturesSelected', $this->getCombinedPictures());
    }

    public function removeAll()
    {
        $this->pictures = [];
        $this->picture_titles = [];
        $this->dispatch('picturesSelected', []);
    }

    public function render()
    {
        return view('livewire.property-images');
    }
}

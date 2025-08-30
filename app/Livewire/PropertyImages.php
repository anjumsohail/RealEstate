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
//dd("Child received event with propertyId: " . $propertyId);
            $this->dispatch('console-log', message: 'Received Property ID '.$propertyId);
        logger()->info("Child savePictures called!", ['propertyId' => $propertyId]);

        foreach ($this->pictures as $index => $file) {
                        if (!$file) {
                                        logger()->warning("File at index $index is empty");
                                         $this->dispatchBrowserEvent('console-log','No File at index' );
                                         
                                        continue;
                                    }


            $path = $file->store('property_images', 'public');

             $this->dispatch('console-log', message: 'File Path '.$path);

             // Delete temp file manually
    if (method_exists($file, 'getRealPath') && file_exists($file->getRealPath())) {
        @unlink($file->getRealPath());
    }
            PropertyPicture::create([
                'property_advertisement_id' => $propertyId,
                'image_path'  => $path,
                'title'       => $this->picture_titles[$index] ?? null,
            ]);
logger()->info("Child savePictures Saved");
    $this->dispatch('console-log', [
    'pictures' => $path,
    'titles'   => $this->picture_titles[$index],
        ]);

        }
    $this->dispatch('console-log','Quit Saving' );
    logger()->info("Quit Child Saving");
        // Reset after saving
        $this->pictures = [];
        $this->picture_titles = [];
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

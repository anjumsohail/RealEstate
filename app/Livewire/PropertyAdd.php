<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\PropertyAdvertisement;
use Livewire\Attributes\On;
use App\Livewire\Throwable;

class PropertyAdd extends Component
{

    public $purpose = '';
    public $category = '';
    public $proptype = '';
    public $title = '';
    public $description = '';
    public $address;
    public $city_id;
    public $town_id;
    public $sector_id;
    public $block_id;
    public $latitude;
    public $longitude;
    public $area_size;
    public $size_unit;
    public $positioning;
    public $front_face;
    public $back_site;
    public $demand_price;
    public $pricetype;
    public $postas;
    public $social;
    public $floor;
    public $housetype;
    public $bedrooms;
    public $conscond;
    public $consage;
    public $propertyId;
    public $mode;


    public function mount($propertyId = null)
    {

        if ($propertyId) {
            // Editing existing property
            $this->mode = 'edit';
            $this->propertyId = $propertyId;
            $property = PropertyAdvertisement::findOrFail($this->propertyId);
            // populate form fields
            $this->purpose = $property->purpose;
            $this->title = $property->title;
            $this->description = $property->description;
            $this->category = $property->category;
            $this->proptype = $property->proptype;
            $this->address = $property->address;
            $this->city_id = $property->city_id;
            $this->town_id = $property->town_id;
            $this->sector_id = $property->sector_id;
            $this->block_id = $property->block_id;
            $this->latitude = $property->latitude;
            $this->longitude = $property->longitude;
            $this->area_size = $property->area_size;
            $this->size_unit = $property->size_unit;
            $this->positioning = $property->positioning;
            $this->front_face = $property->front_face;
            $this->back_site = $property->back_site;
            $this->demand_price = $property->demand_price;
            $this->pricetype = $property->pricetype;
            $this->postas = $property->postas;
            $this->social = $property->social;
            $this->floor = $property->floor;
            $this->housetype = $property->housetype;
            $this->bedrooms = $property->bedrooms;
            $this->conscond = $property->conscond;
            $this->consage = $property->consage;
        }
    }

    // Listener to catch images forwarded from child
    protected $listeners = ['MapUpdated', 'geographySelected'];
    public function MapUpdated($coordinates)
    {
        $lat = $coordinates['latitude'];
        $lng = $coordinates['longitude'];

        $this->dispatch('log', message: "Latitude-Longitude: {$lat}, {$lng}");

        $this->latitude  = $lat;
        $this->longitude = $lng;
    }
    public function geographySelected($CityParams)
    {

        $this->city_id = $CityParams['city_id'];
        $this->town_id = $CityParams['town_id'];
        $this->sector_id = $CityParams['sector_id'];
        $this->block_id = $CityParams['block_id'];
        $this->dispatch('log', message: json_encode($CityParams));
    }

    protected $rules = [
        'purpose' => 'required|in:Sale,Rent',
        'category' => 'required|in:Residential,Commercial',
        'proptype' => 'required|in:Plot,Home,Apartment,Portion,Cottage',
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'address' => 'nullable|string|max:255',
        'city_id' => 'required|string|max:100',
        'town_id' => 'nullable|string|max:100',
        'sector_id' => 'nullable|string|max:100',
        'block_id' => 'nullable|string|max:100',
        'latitude' => 'nullable|numeric|between:-90,90',
        'longitude' => 'nullable|numeric|between:-180,180',
        'area_size' => 'required|string|min:0',
        'size_unit' => 'required',
        'positioning' => 'nullable|string|max:255',
        'front_face' => 'nullable|string|max:255',
        'back_site' => 'nullable|string|max:255',
        'demand_price' => 'required|numeric|min:0',
        'pricetype' => 'nullable|string|max:255',
        'floor' => 'nullable|string|max:255',
        'bedrooms' => 'nullable|string|max:255',
        'conscond' => 'nullable|string|max:255',
        'consage' => 'nullable|string|max:255',
        'postas' => 'nullable|string|max:255',
        'social' => 'nullable|string|max:255',


    ];

    public function save()
    {
        try {
            // ✅ Validate input

            $data = $this->validate();
            // ✅ Add user_id
            $data['user_id'] = Auth::id();
            // ✅ Save main property
            $property = PropertyAdvertisement::create($data);
            $this->propertyId = $property->id;
            // ✅ Ask child to save pictures for this property

            $this->dispatch('savePictures', propertyId: $this->propertyId)->to('property-images');
        } catch (\Throwable $e) {
            // ❌ Roll back everything
            logger()->error('Transaction failed', ['error' => $e->getMessage()]);

            session()->flash('error', 'Failed to save property. Please try again.');
            return;
        }
    }

    public function modify()
    {
        try {
            // ✅ Validate input
            if ($this->mode === 'edit') {
                $property = PropertyAdvertisement::findOrFail($this->propertyId);
                $property->update([
                    'title' => $this->title,
                    'purpose' => $this->purpose,
                    'description' => $this->description,

                ]);

                session()->flash('success', 'Property updated successfully!');
            }

            $this->dispatch('savePictures', propertyId: $this->propertyId)->to('property-images');
        } catch (\Throwable $e) {
            // ❌ Roll back everything
            logger()->error('Transaction failed', ['error' => $e->getMessage()]);

            session()->flash('error', 'Failed to save property. Please try again.');
            return;
        }
    }

    #[On('picturesStatus')]
    public function rollbackProperty($status, $message)
    {
        if ($status === 'success') {
            $this->reset();
            session()->flash('success', 'Property advertisement created successfully!');

            return $this->redirectRoute('dashboard');
        }

        // rollback failed child upload
        PropertyAdvertisement::find($this->propertyId)?->delete();

        logger()->warning("Rolling back property due to failed image upload: $message");
        session()->flash('error', "Failed to upload pictures: $message");
        return;
    }

    public function render()
    {
        return view('livewire.property-add');
    }
}

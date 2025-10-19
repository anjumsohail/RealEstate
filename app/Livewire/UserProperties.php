<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use App\Models\PropertyAdvertisement;

class UserProperties extends Component
{
    use WithPagination;
    public $purposeFilter = null;     // 'rent', 'sale', 'purchase', or null
    public $sortField = 'created_at'; // default sort field
    public $sortDirection = 'desc';   // 'asc' or 'desc'
    public $perPage = 5;
    public $search = '';
    public $filterType = '%';
    public $filterCategory = '%';
    public $filterPurpose = '%';
    public $filterStatus = '%';


    public function setType(string $type)
    {
        if ($type == 'All') {
            $this->filterType = '%';
        } else {
            $this->filterType = $type;
        }
    }
    public function setCategory(string $type)
    {
        if ($type == 'All') {
            $this->filterCategory = '%';
        } else {
            $this->filterCategory = $type;
        }
    }
    public function setPurpose(string $type)
    {
        if ($type == 'All') {
            $this->filterPurpose = '%';
        } else {
            $this->filterPurpose = $type;
        }
    }
    public function setStatus(string $type)
    {
        if ($type == 'All') {
            $this->filterStatus = '%';
        } else {
            if ($type == 'Approved') {
                $this->filterStatus = 1;
            } else {
                $this->filterStatus = 0;
            }
        }
    }



    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function toggleSort($field)
    {
        $this->sortField = $field;

        if ($this->sortDirection == 'desc') {
            $this->sortDirection = 'asc';
        } else {

            $this->sortDirection = 'desc';
        }
    }




    public function deleteProperty(PropertyAdvertisement $propertyAdvertisement)
    {
        $propertyAdvertisement->delete();
    }


    public function showDetail($id)
    {
        // Emit event to parent components and PropertyDetail component
        $this->dispatch('showPropertyDetail', propertyId: $id);
    }

    public function render()
    {

        $properties = PropertyAdvertisement::where('user_id', Auth::user()->id)
            ->where('approved', 'like', $this->filterStatus)
            ->where('proptype', 'like', $this->filterType)
            ->where('purpose', 'like', $this->filterPurpose)
            ->where('category', 'like', $this->filterCategory)
            ->when($this->search, function ($query) {
                $query->where('title', 'like', "%{$this->search}%");
            })->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);


        $purpose = ['All', 'Sale', 'Rent', 'purchase'];
        $category = ['All', 'Residential', 'Commercial'];
        $type = ['All', 'Plot', 'Office', 'Shop', 'Home', 'Apartment', 'Portion', 'Cottage'];
        $status = ['All', 'Approved', 'Pending'];

        return view('livewire.user-properties', compact('properties', 'purpose', 'category', 'type', 'status'));
    }
}

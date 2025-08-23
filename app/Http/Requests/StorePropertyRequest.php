<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
protected function prepareForValidation()
{
    $this->merge([
        'user_id' => Auth::user()->id,
    ]);
}

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
       //dd(request()->all()); // or Log::info(request()->all());
        return [
            'purpose' => 'required|in:Sale,Rent',
            'category' => 'required|in:Residential,Commercial',
            'proptype' => 'required|in:Plot,Home,Apartment,Portion,Cottage',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'city_id' => 'required|string|max:100',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'area_size' => 'required|string|min:0',
            'size_unit' => 'required',
            'positioning' => 'nullable|in:East Open,West Open,North Open,South Open',
            'front_face' => 'nullable|string|max:255',
            'back_site' => 'nullable|string|max:255',
            'demand_price' => 'required|numeric|min:0',
            'property_image' => 'nullable|image|mimes:jpg,png,jpeg|max:4096',
            'user_id' => 'required|exists:users,id'
        ];
    }
}

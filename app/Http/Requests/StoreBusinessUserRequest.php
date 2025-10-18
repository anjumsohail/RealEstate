<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBusinessUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'business_nature' => 'required',
            'company_name' => 'required|string|max:255',
            'company_description' => 'nullable|string',
            'designation' => 'nullable|string|max:255',
            'city_id' => 'required',
            'services' => 'nullable',
            'facebook_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'vcard'=> 'nullable|image|mimes:jpg,png,jpeg|max:2048',
             'logo'=> 'nullable|image|mimes:jpg,png,jpeg|max:2048',



        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StoreUserRequest extends FormRequest
{
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
    public function rules(): array
    {
        return [

            'user.user_type' => 'required|in:Individual,Business',
            'user.name' => 'required|string|max:255',

            // ✅ Use Rule::unique() correctly
            'user.email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore(optional($this->user())->id),
            ],

            'user.mobile' => [
                'required',
                'regex:/^92\d{10}$/',
                Rule::unique('users', 'mobile')->ignore(optional($this->user())->id),
            ],

            'user.password' => $this->user()?->id ? 'nullable|string|min:6' : 'required|string|min:6',
            'user.address' => 'nullable|string',
            'user.profile_photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'user.landline' => 'nullable|string|max:20',
            'user.whatsapp' => 'nullable|string|max:20',

            'profile.business_nature' => 'required_if:user_type,Business|array',
            'profile.company_name' => 'required_if:user_type,Business|string|max:255',
            'profile.company_description' => 'nullable|string',
            'profile.designation' => 'nullable|string|max:255',
            'profile.city_id' => 'required_if:user_type,Business|string|max:100',
            'profile.services' => 'nullable|array',
            'profile.facebook_url' => 'nullable|url',
            'profile.youtube_url' => 'nullable|url',
            'profile.linkedin_url' => 'nullable|url',
            'profile.latitude' => 'nullable|numeric|between:-90,90',
            'profile.longitude' => 'nullable|numeric|between:-180,180',
            'profile.vcard' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'profile.logo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ];
    }
}

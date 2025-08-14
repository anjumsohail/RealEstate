<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'user_type' => 'required|in:Individual,Business',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|regex:/^92\d{10}$/|unique:users,mobile',
            'password' => 'required|string|min:6',
            'address' => 'nullable|string',
            'profile_photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'landline' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20'
        ];
    }
}

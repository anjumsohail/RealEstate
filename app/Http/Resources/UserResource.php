<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       
    {
        $data = [
            'id' => $this->id,
            'user_type' => $this->user_type,
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'address' => $this->address,
            'profile_photo' => $this->profile_photo,
            'landline' => $this->landline,
            'whatsapp' => $this->whatsapp,
        ];

        // Add business profile if user_type is Business and relationship loaded
        if ($this->user_type === 'Business' && $this->relationLoaded('businessProfile') && $this->businessProfile) {
            $data['business_profile'] = [
                'business_nature' => $this->businessProfile->business_nature,
                'company_name' => $this->businessProfile->company_name,
                'company_description' => $this->businessProfile->company_description,
                'designation' => $this->businessProfile->designation,
                'city' => $this->businessProfile->city,
                'services' => $this->businessProfile->services,
                'facebook_url' => $this->businessProfile->facebook_url,
                'youtube_url' => $this->businessProfile->youtube_url,
                'linkedin_url' => $this->businessProfile->linkedin_url,
                'latitude' => $this->businessProfile->latitude,
                'longitude' => $this->businessProfile->longitude,
            ];
        }

        // Add properties if eager loaded
        if ($this->relationLoaded('properties')) {
            $data['properties'] = PropertyAdvertisementResource::collection($this->properties);
        }

        return $data;
    }
    }
}

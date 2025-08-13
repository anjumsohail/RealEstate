<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class PropertyAdvertisementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
         return [
            'id' => $this->id,
            'purpose' => $this->purpose,
            'category' => $this->category,
            'type' => $this->type,
            'title' => $this->title,
            'description' => $this->description,
            'address' => $this->address,
            'city' => $this->city,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'area_size' => $this->area_size,
            'size_unit' => $this->size_unit,
            'positioning' => $this->positioning,
            'front_face' => $this->front_face,
            'back_site' => $this->back_site,
            'demand_price' => $this->demand_price,
            'property_image' => $this->property_image,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'owner' => new UserResource($this->whenLoaded('user')),
        ];
    }

    
}

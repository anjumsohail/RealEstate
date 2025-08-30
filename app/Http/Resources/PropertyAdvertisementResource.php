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
            'PropType' => $this->proptype,
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
            'city_id'=> $this->city_id ,
            'town_id'=> $this->town_id,
            'sector_id' => $this->sector_id,
            'block_id'=> $this->block_id,
            'postas' => $this->postas,
            'social'=> $this->social,
            'pricetype' => $this->pricetype,
            'floor' => $this->floor,
            'bedrooms' => $this->bedrooms,
            'conscond' => $this->conscond,
            'consage' => $this->consage,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'owner' => new UserResource($this->whenLoaded('user')),
        ];
    }

    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyAdvertisement extends Model
{
    //
    protected $fillable = [
        'purpose', 'category', 'type', 'title', 'description', 'address', 'city',
        'latitude', 'longitude', 'area_size', 'size_unit', 'positioning',
        'front_face', 'back_site', 'demand_price', 'property_image', 'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}

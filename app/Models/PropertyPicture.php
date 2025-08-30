<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyPicture extends Model
{
    protected $fillable = ['property_advertisement_id', 'title', 'image_path'];

    public function property()
    {
        return $this->belongsTo(PropertyAdvertisement::class);
    }
}

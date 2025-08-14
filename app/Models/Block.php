<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    //
      protected $fillable = ['name', 'sector_id'];

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }
    public function propertyAdvertisements()
{
    return $this->hasMany(PropertyAdvertisement::class);
}
}

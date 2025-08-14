<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
        protected $fillable = ['name'];

    public function towns()
    {
        return $this->hasMany(Town::class);
    }
    public function propertyAdvertisements()
{
    return $this->hasMany(PropertyAdvertisement::class);
}
}

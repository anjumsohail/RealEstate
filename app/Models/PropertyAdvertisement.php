<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyAdvertisement extends Model
{
    //
    protected $fillable = [
        'purpose', 'category', 'proptype', 'title', 'description', 'address', 
        'latitude', 'longitude', 'area_size', 'size_unit', 'positioning',
        'front_face', 'back_site', 'demand_price','user_id',
        'city_id','town_id','sector_id','block_id','postas','social',
        'pricetype','floor','bedrooms','conscond','consage'
    ];
    // Refereces 
    public function user() {
        return $this->belongsTo(User::class);
    }
        public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function town()
    {
        return $this->belongsTo(Town::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function block()
    {
        return $this->belongsTo(Block::class);
    }
    public function pictures()
    {
        return $this->hasMany(PropertyPicture::class);
    }
}

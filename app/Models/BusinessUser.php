<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessUser extends Model
{
    //    
    protected $fillable = [
        'user_id',
        'business_nature',
        'company_name',
        'company_description',
        'designation',
        'city',
        'services',
        'facebook_url',
        'youtube_url',
        'linkedin_url',
        'latitude',
        'longitude'
    ];

    protected $casts = [
        'services' => 'array',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

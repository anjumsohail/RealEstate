<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class BusinessUser extends Model
{
    //
    protected $fillable = [
        'user_id',
        'business_nature',
        'company_name',
        'company_description',
        'designation',
        'city_id',
        'services',
        'facebook_url',
        'youtube_url',
        'linkedin_url',
        'latitude',
        'longitude',
        'logo',
        'vcard',


    ];

    protected $casts = [
        'business_nature' => 'array',
        'services' => 'array',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function deleteLogo()
    {
        if ($this->logo) {
            Storage::disk('public')->delete($this->logo);
            $this->update(['profile_photos' => null]);
        }
    }

    public function deleteVcard()
    {
        if ($this->vcard) {
            Storage::disk('public')->delete($this->vcard);
            $this->update(['profile_photos' => null]);
        }
    }
}

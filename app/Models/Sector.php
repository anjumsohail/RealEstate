<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    //
      protected $fillable = ['name', 'town_id'];

    public function town()
    {
        return $this->belongsTo(Town::class);
    }

    public function blocks()
    {
        return $this->hasMany(Block::class);
    }
}

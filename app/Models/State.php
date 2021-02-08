<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    public function relCountry()
    {
        // uno a uno
        return $this->hasOne(Country::class,'id','country_id');
    }
    public function cities()
    {
        return $this->hasMany(City::class);
    }
}


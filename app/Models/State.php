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
    // llama esta relacion en ->with(cities) de countryController para el combo si no esta esta relacion no anda
    public function cities()
    {
        return $this->hasMany(City::class);
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public function relCountry()
    {
        return $this->hasOne(Country::class,'id','country_id');
    }

    public function relState()
    {
        return $this->hasOne(State::class,'id','state_id');
    }

    public function relCompany()
    {
        return $this->hasOne(Company::class,'id','company_id');
    }

}

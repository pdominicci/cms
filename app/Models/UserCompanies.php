<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCompanies extends Model
{
    use HasFactory;

    public function relCompany()
    {
        return $this->hasMany(UserCompanies::class,'user_id','company_id');
    }
    public function companies()
    {
        return $this->hasOne(Company::class,'id','company_id');
    }
}

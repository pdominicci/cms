<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'products';
    protected $hidden = ['created_at', 'updated_at'];

    public function relCategory()
    {
        // uno a uno
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function getGallery(){
        // se pone asi y laravel se da cuenta que es una relacion uno a muchos
        // o se puede poner asi despues de class -->>>  ,'product_id','id');
        return $this->hasMany(PGallery::class);
    }
    public function relCompany()
    {
        // uno a uno
        return $this->hasOne(Company::class,'id','company_id');
    }
}

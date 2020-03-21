<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function products(){
        return $this->hasMany(Products::class, "category_id", "id");
    }
}

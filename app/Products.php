<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = [
        'product_name',
        'product_price',
        'product_image',
        'category_id'
    ];

    public function category(){
        return $this->hasOne(Category::class, "id", "category_id");
    }
}

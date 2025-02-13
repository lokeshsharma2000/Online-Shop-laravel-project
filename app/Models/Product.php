<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $guarded = [];



    public function category()
{
    return $this->belongsTo(Category::class,'categoryID');
}

public function subcategory()
{
    return $this->belongsTo(Subcategory::class,'subcategoryID');
}


public function items(){
    return $this->hasMany(OrderItem::class);
}

public function productRating()
{
    return $this->hasMany(Rating::class,'productID');
}

}

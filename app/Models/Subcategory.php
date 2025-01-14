<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $table = 'subcategory';
    protected $guarded = [];

    public function category()
{
    return $this->belongsTo(Category::class);
}

public function products()
{
    return $this->belongsTo(Products::class);
}



}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
protected $table = 'ratings';
protected $guarded = [];


public function order()
{
    return $this->belongsTo(Order::class,'orderID');
}

public function product()
{
    return $this->belongsTo(Product::class,'productID');
}

public function user()
{
    return $this->belongsTo(User::class,'userID');
}
}

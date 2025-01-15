<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['cartID', 'productID', 'quantity', 'unitPrice', 'lineTotal'];

    public function cart()
    {
        return $this->belongsTo(Cart::class,'cartID');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'ProductID');
    }
}

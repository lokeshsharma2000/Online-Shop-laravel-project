<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'userID',
        // 'productID',
        // 'quantity',
        'totalPrice',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'userID');
    }
    
public function items(){
    return $this->hasMany(OrderItem::class,'orderID');
}

//     public function product()
//     {
//         return $this->belongsTo(Product::class,'productID');
//     }
 }

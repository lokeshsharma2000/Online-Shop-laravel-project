<?php

namespace App\Http\Controllers;
use App\Models\Rating;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class RatingController extends Controller
{
  
    public function showRating($orderId,$productId){
        $order = Order::findOrFail($orderId);
    $product = Product::findOrFail($productId);
    return view('rating',compact('order','product'));
    }


        public function store(Request $request, $orderId, $productId)
        {
            $user = auth()->user();
                $order = Order::findOrFail($orderId);
            if ($order->status !== 'complete') {
                return response()->json(['message' => 'You can only rate orders that are complete.'], 400);
            }
    
            $existingRating = Rating::where('orderID', $orderId)
                ->where('productID', $productId)
                ->where('userID', $user->id)
                ->first();
    
            if ($existingRating) {
                return response()->json(['message' => 'You have already rated this product for this order.'], 400);
            }
    
            $validated = $request->validate([
                'rating' => 'required|integer|between:1,5'
            ]);
    
            $rating = Rating::create([
                'orderID' => $orderId,
                'productID' => $productId,
                'userID' => $user->id,
                'rating' => $validated['rating']
            ]);
    
            return redirect()->route('user.orders')->with('success', 'Thank you for your rating!');
        }
    }
    


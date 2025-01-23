<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Rating;


use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Method to handle displaying the dashboard
    
    public function index()
    {
        $products = Product::with('category', 'subcategory','productRating')->get();
        foreach ($products as $product) {
            $averageRating = Rating::where('productID', $product->id)->avg('rating');            
            $product->average_rating = $averageRating ? round($averageRating, 1) : 0; 
         }
    return view('welcome', compact('products'));
}
}


<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;


use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Method to handle displaying the dashboard
    
    public function index()
    {
        $products = Product::with('category', 'subcategory')->get();
        // return $products;
        return view('welcome', compact('products'));
    }

    
}


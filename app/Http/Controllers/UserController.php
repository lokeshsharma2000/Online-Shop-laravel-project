<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
public function user(){
    return view('detail.info');
}

public function index()
{
    $products = Product::with('category', 'subcategory')->get();
    // return $products;
    return view('products.index', compact('products'));
}
}

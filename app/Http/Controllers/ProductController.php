<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class productController extends Controller
{
    function index()
    {
        $products = Product::where('featured', true)->inRandomOrder()->take(8)->get();

        return view('landing_page')->with('products', $products);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class productController extends Controller
{
    function index()
    {
        $products = Product::where('featured', true)->inRandomOrder()->take(8)->get();

        return view('landing_page')->with('products', $products);
    }

    function search(Request $request)
    {
        $request->validate([
            'query' => 'required|min:3',
        ]);

        $query = $request->input('query');


        $products = Product::where('name', 'like', "%$query%")
            ->orwhere('details', 'like', "%$query%")
            ->orwhere('description', 'like', "%$query%")
            ->paginate(15);

        return view('search_results')->with('products', $products);
    }
}

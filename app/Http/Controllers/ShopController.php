<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class shopController extends Controller
{
    function index()
    {
        $categories = Category::all();
        $pagination = 9;

        if (request()->category) {
            $products = Product::with('categories')->whereHas('categories', function ($query) {
                $query->where('slug', request()->category);
            });

            $categoryName = optional($categories->where('slug', request()->category)->first())->name;
        } else {

            $products = Product::where('featured', true)->take(12)->inRandomOrder();
            $categoryName = 'All';
        }

        if (request()->sort == 'high_low') {
            $products = $products->orderBy('price', 'desc')->paginate($pagination);
        } elseif (request()->sort == 'low_high') {
            $products = $products->orderBy('price')->paginate($pagination);
        } else {
            $products = $products->paginate($pagination);
        }

        return view('shop_index')->with(['products' => $products, 'categories' => $categories, 'categoryName' => $categoryName]);
    }

    function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        $mightAlsoLike = Product::where('slug', '!=', $slug)->MightAlsoLike()->get();

        return view('shop_show')->with(['product' => $product, 'mightAlsoLike' => $mightAlsoLike]);
    }
}

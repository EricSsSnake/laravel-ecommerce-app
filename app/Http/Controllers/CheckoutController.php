<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    function index()
    {
        if (Cart::instance('default')->count() == 0) {
            return redirect()->route('cartIndex', App::getLocale())->withErrors('Your shopping cart is empty! Please select an item to checkout.');
        }

        $discount = session()->has('coupon') ? session()->get('coupon')['discount'] : 0;

        return view('checkout_index')->with(['lang' => App::getLocale(), 'discount' => $discount]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    function index()
    {
        $discount = session()->has('coupon') ? session()->get('coupon')['discount'] : 0;

        return view('checkout_index')->with([
            'discount' => $discount
        ]);
    }
}

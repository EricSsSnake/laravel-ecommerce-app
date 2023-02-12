<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CouponController extends Controller
{
    function store()
    {
        $coupon = Coupon::findByCode(request()->coupon_code);

        if (!$coupon) {
            return redirect()->route('checkoutIndex')->withErrors('Coupon code is invalid!');
        }

        session()->put('coupon', [
            'code' => $coupon->code,
            'discount' => $coupon->discount(Cart::subtotal())
        ]);

        return redirect()->route('checkoutIndex')->with('success_message', 'Coupon has been applied!');
    }

    function destroy()
    {
        session()->forget('coupon');

        return redirect()->route('checkoutIndex')->with('success_message', 'Coupon has been removed!');
    }
}

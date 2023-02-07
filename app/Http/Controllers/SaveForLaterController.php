<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class SaveForLaterController extends Controller
{
    function destroy($id)
    {
        Cart::instance('saveForLater')->remove($id);

        return redirect('/cart');
    }

    function switchToCart($id)
    {
        $item = Cart::instance('saveForLater')->get($id);

        Cart::instance('saveForLater')->remove($id);

        $duplicates = Cart::instance('default')->search(function ($cartItem) use ($id) {
            return $cartItem->id == $id;
        });

        if (count($duplicates) > 0) {
            return redirect('/cart')->with('success_message', 'Item is already in your cart!');
        }

        Cart::instance('default')->add($item->id, $item->name, 1, $item->price)->associate('App\Models\Product');

        return redirect('/cart')->with('success_message', 'Item has been moved to your cart!');
    }
}

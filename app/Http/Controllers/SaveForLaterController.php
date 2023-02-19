<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Gloudemans\Shoppingcart\Facades\Cart;

class SaveForLaterController extends Controller
{
    function destroy($lang, $id)
    {
        Cart::instance('saveForLater')->remove($id);

        return redirect(route('cartIndex', App::getLocale()));
    }

    function switchToCart($lang, $id)
    {
        $item = Cart::instance('saveForLater')->get($id);

        Cart::instance('saveForLater')->remove($id);

        $duplicates = Cart::instance('default')->search(function ($cartItem) use ($id) {
            return $cartItem->id == $id;
        });

        if (count($duplicates) > 0) {
            return redirect(route('cartIndex', App::getLocale()))->with('success_message', 'Item is already in your cart!');
        }

        Cart::instance('default')->add($item->id, $item->name, 1, $item->price)->associate('App\Models\Product');

        return redirect(route('cartIndex', App::getLocale()))->with('success_message', 'Item has been moved to your cart!');
    }
}

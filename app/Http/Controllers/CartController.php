<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Darryldecode\Cart\Validators\Validator;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    function index()
    {
        $mightAlsoLike = Product::MightAlsoLike()->get();

        return view('cart_index')->with('mightAlsoLike', $mightAlsoLike);
    }

    function store(Request $request)
    {
        $duplicates = Cart::search(function ($cartItem) use ($request) {
            return $cartItem->id == $request->id;
        });

        if (count($duplicates) > 0) {
            return redirect('/cart')->with('success_message', 'Item is already in your Cart!');
        };

        Cart::add($request->id, $request->name, 1, $request->price)->associate('App\Models\Product');

        return redirect('/cart')->with('success_message', 'Item was added to your cart!');
    }

    function destroy($id)
    {
        Cart::remove($id);

        return redirect('/cart')->with('success_message', 'Item was was deleted from your cart!');
    }

    function switchToSaveForLater($id)
    {
        $item = Cart::get($id);

        Cart::remove($id);

        $duplicates = Cart::instance('saveForLater')->search(function ($cartItem) use ($id) {
            return $cartItem->id == $id;
        });

        if (count($duplicates) > 0) {
            return redirect('/cart')->with('success_message', 'Item is already Saved for Later!');
        };

        Cart::instance('saveForLater')->add($item->id, $item->name, 1, $item->price)->associate('App\Models\Product');

        return redirect('/cart')->with('success_message', 'Item has been saved for later!');
    }

    function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|between: 1,5'
        ]);

        if ($validator->fails()) {
            session()->flash('errors', collect(['Quantity must be between 1 and 5!']));
            return response()->json(['success' => false]);
        }

        Cart::update($id, $request->quantity);
        session()->flash('success_message', 'Quantity was updated successfully!');
        return response()->json(['success' => true]);
    }
}

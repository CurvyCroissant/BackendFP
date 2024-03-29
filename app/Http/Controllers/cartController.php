<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Invoice;

class cartController extends Controller
{

    public function createForUser($userId)
    {
        if (!is_numeric($userId)) {
            return null;
        }

        $existingCart = Cart::where('user_id', $userId)->first();
        if ($existingCart) {
            return $existingCart;
        }

        $userCart = Cart::create([
            'user_id' => $userId,
        ]);

        return $userCart;
    }

    public function display(Cart $cart)
    {
        $invoice = $cart->invoice;
        $cartData = $cart->item;

        return view('cartDisplay', [
            'title' => 'Cart',
            'cart' => $cart,
            'invoice' => $invoice,
            'cartData' => $cartData,
        ]);
    }

    public function store(Request $request, Cart $cart)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
        ]);

        $cart->item()->attach($request->input('item_id'));

        return redirect()->route('cart.display', $cart->id)->with('success', 'Item added to cart successfully!');
    }
}

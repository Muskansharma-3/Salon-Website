<?php

// app/Http/Controllers/CartController.php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Product $product)
    {
        $user = Auth::user();
        $cartItem = $user->carts()->where('product_id', $product->id)->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            $user->carts()->create([
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Product added to cart.');
    }

    public function index()
    {
        $cartItems = Auth::user()->carts()->with('product')->get();
        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        return view('cart', compact('cartItems', 'total'));
    }

    public function remove($id)
    {
        $cartItem = Cart::findOrFail($id);
        if ($cartItem->user_id === Auth::id()) {
            $cartItem->delete();
        }

        return redirect()->route('cart')->with('success', 'Item removed from cart.');
    }
    public function increment($id)
{
    $cartItem = Cart::findOrFail($id);

    if ($cartItem->user_id === Auth::id()) {
        $cartItem->increment('quantity');
    }

    return redirect()->route('cart');
}

public function decrement($id)
{
    $cartItem = Cart::findOrFail($id);

    if ($cartItem->user_id === Auth::id()) {
        if ($cartItem->quantity > 1) {
            $cartItem->decrement('quantity');
        } else {
            $cartItem->delete(); // Remove if quantity goes below 1
        }
    }

    return redirect()->route('cart');
}

}



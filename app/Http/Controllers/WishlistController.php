<?php

// app/Http/Controllers/WishlistController.php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function addToWishlist(Product $product)
    {
        $user = Auth::user();
        $exists = $user->wishlists()->where('product_id', $product->id)->exists();

        if (!$exists) {
            $user->wishlists()->create([
                'product_id' => $product->id,
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Product added to wishlist.');
    }

    public function index()
    {
        $wishlistItems = Auth::user()->wishlists()->with('product')->get();
        return view('wishlist', compact('wishlistItems'));
    }

    public function remove($id)
    {
        $item = Wishlist::findOrFail($id);
        if ($item->user_id === Auth::id()) {
            $item->delete();
        }

        return redirect()->route('wishlist')->with('success', 'Item removed from wishlist.');
    }
}



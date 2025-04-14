<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Show products to users
    public function index()
    {
        $signatureProducts = Product::where('is_signature', true)->get();
        $otherProducts = Product::where('is_signature', false)->get();

        return view('products.index', compact('signatureProducts', 'otherProducts'));
    }

    // Show all products to admin
    public function adminIndex()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    // Show create form
    public function create()
    {
        return view('admin.products.create');
    }

    // Store new product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
            'is_signature' => 'boolean'
        ]);

        $product = new Product($request->only('name', 'price', 'is_signature'));

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->image = 'storage/' . $path;
        }

        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Product added successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    // Update product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
            'is_signature' => 'boolean'
        ]);

        $product->fill($request->only('name', 'price', 'is_signature'));

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->image = 'storage/' . $path;
        }

        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    // Delete product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}

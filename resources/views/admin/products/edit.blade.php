@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6 text-indigo-700">Edit Product</h1>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium">Name</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="w-full p-2 border rounded">
        </div>

        <div>
            <label class="block font-medium">Price</label>
            <input type="number" name="price" step="0.01" value="{{ old('price', $product->price) }}" required class="w-full p-2 border rounded">
        </div>

        <div>
            <label class="block font-medium">Is Signature Product?</label>
            <select name="is_signature" class="w-full p-2 border rounded">
                <option value="0" {{ old('is_signature', $product->is_signature) == 0 ? 'selected' : '' }}>No</option>
                <option value="1" {{ old('is_signature', $product->is_signature) == 1 ? 'selected' : '' }}>Yes</option>
            </select>
        </div>

        <div>
            <label class="block font-medium">Product Image</label>
            <input type="file" name="image" accept="image/*" class="w-full p-2 border rounded">
            @if ($product->image)
                <div class="mt-2">
                    <img src="{{ Storage::url('products/' . $product->image) }}" alt="Product Image" class="w-24 h-24 object-cover rounded">
                </div>
            @endif
        </div>

        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">Update Product</button>
    </form>
</div>
@endsection

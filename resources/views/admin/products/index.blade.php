@extends('layouts.admin') {{-- Assuming you have an admin layout --}}

@section('content')
<div class="max-w-6xl mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6 text-indigo-700">All Products</h1>

    <a href="{{ route('admin.products.create') }}" class="mb-4 inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded">
        + Add New Product
    </a>

    <table class="w-full border shadow-md rounded overflow-hidden">
        <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="px-4 py-2 text-left">Image</th>
                <th class="px-4 py-2 text-left">Name</th>
                <th class="px-4 py-2 text-left">Price</th>
                <th class="px-4 py-2 text-left">Type</th>
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr class="border-t">
                <td class="px-4 py-2">
                    @if($product->image)
                    <img src="{{ asset('storage/products/' . $product->image) }}" alt="Product Image" class="w-16 h-16 object-cover rounded">
                    @else
                        <span class="text-gray-400 italic">No image</span>
                    @endif
                </td>
                <td class="px-4 py-2">{{ $product->name }}</td>
                <td class="px-4 py-2">₹{{ $product->price }}</td>
                <td class="px-4 py-2">
                    {{ $product->is_signature ? 'Signature' : 'Regular' }}
                </td>
                <td class="px-4 py-2 flex gap-2">
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="text-indigo-600 font-semibold hover:underline">Edit</a>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 font-semibold hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-4 py-6 text-center text-gray-500">No products found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

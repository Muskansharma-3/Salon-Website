@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-12 px-4">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-3xl font-bold text-center text-indigo-700 mb-12">Your Wishlist</h2>

        @if($wishlistItems->isEmpty())
            <p class="text-gray-700 bg-white bg-opacity-90 p-4 rounded-md shadow w-fit">
                Your wishlist is empty.
            </p>
        @else
            <div class="space-y-8">
                @foreach($wishlistItems as $item)
                    <div class="flex justify-between items-center bg-white bg-opacity-90 p-4 rounded-xl shadow">
                        <div class="flex items-center space-x-4">
                            <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" class="w-24 h-24 object-contain rounded-md">
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800">{{ $item->product->name }}</h4>
                                <p class="text-indigo-600 font-bold mt-2">₹{{ $item->product->price }}</p>
                            </div>
                        </div>
                        <div class="flex space-x-4">
                            <!-- Add to Cart -->
                            <form action="{{ route('cart.add', $item->product->id) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                                    Add to Cart
                                </button>
                            </form>

                            <!-- Remove from Wishlist -->
                            <form action="{{ route('wishlist.remove', $item->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                                    Remove
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection

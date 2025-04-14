@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-12 px-4">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-3xl font-bold text-center text-indigo-700 mb-12">Your Cart</h2>

        @if($cartItems->isEmpty())
            <p class="text-gray-700 bg-white bg-opacity-90 p-4 rounded-md shadow w-fit">
                Your cart is empty.
            </p>
        @else
            <div class="space-y-8">
                @foreach($cartItems as $item)
                    <div class="flex justify-between items-center bg-white bg-opacity-90 p-4 rounded-xl shadow">
                        <div class="flex items-center space-x-4">
                            <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" class="w-24 h-24 object-cover rounded-md">
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800">{{ $item->product->name }}</h4>
                                <div class="mt-2 flex items-center space-x-2">
    <form action="{{ route('cart.decrement', $item->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <button type="submit" class="px-2 py-1 bg-gray-300 rounded hover:bg-gray-400">–</button>
    </form>

    <span class="text-indigo-700 font-semibold">{{ $item->quantity }}</span>

    <form action="{{ route('cart.increment', $item->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <button type="submit" class="px-2 py-1 bg-gray-300 rounded hover:bg-gray-400">+</button>
    </form>
</div>
<p class="text-indigo-600 font-bold mt-1">₹{{ $item->product->price * $item->quantity }}</p>

                            </div>
                        </div>
                        <div class="space-x-4">
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Remove</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-8 flex justify-between items-center">
                <div class="text-xl font-bold text-indigo-700">
                    Total: ₹{{ $total }}
                </div>
                <a href="{{ route('checkout.index') }}" class="bg-indigo-600 text-white px-6 py-3 rounded hover:bg-indigo-700">Proceed to Checkout</a>
            </div>
        @endif
    </div>
</div>
@endsection

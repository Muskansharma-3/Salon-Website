@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-12 px-4">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow">
        <h2 class="text-2xl font-bold text-indigo-700 mb-6">Checkout</h2>

        @foreach($cartItems as $item)
            <div class="flex justify-between items-center border-b py-4">
                <div>
                    <h4 class="font-semibold text-lg">{{ $item->product->name }}</h4>
                    <p class="text-sm text-gray-600">Quantity: {{ $item->quantity }}</p>
                </div>
                <p class="text-indigo-700 font-bold">₹{{ $item->product->price * $item->quantity }}</p>
            </div>
        @endforeach

        <div class="flex justify-between mt-6 text-xl font-bold text-indigo-700">
            <span>Total:</span>
            <span>₹{{ $total }}</span>
        </div>

        <form action="#" method="POST" class="mt-8">
            @csrf
            <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded hover:bg-indigo-700">
                Place Order (Dummy)
            </button>
        </form>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-12 px-4" 
     x-data="{ selectedProduct: null }">
    <div class="max-w-7xl mx-auto">

        <h2 class="text-3xl font-bold text-center text-indigo-700 mb-12">Our Products</h2>

        <!-- Top-right Cart and Wishlist Icons -->
        <div class="flex justify-end mb-6">
            <div class="flex items-center space-x-6 text-2xl">
                <!-- Cart -->
                <a href="{{ route('cart') }}" class="relative group">
                    🛒
                    <span class="absolute -top-8 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 bg-gray-700 text-white text-xs rounded py-1 px-2 transition duration-200">
                        View Cart
                    </span>
                </a>

                <!-- Wishlist -->
                <a href="{{ route('wishlist') }}" class="relative group">
                    💖
                    <span class="absolute -top-8 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 bg-gray-700 text-white text-xs rounded py-1 px-2 transition duration-200">
                        Wishlist
                    </span>
                </a>
            </div>
        </div>

        {{-- Signature Products --}}
        <div class="mb-20">
            <h3 class="text-2xl font-semibold text-indigo-600 mb-6">Signature Collection</h3>
            @if($signatureProducts->isEmpty())
                <p class="text-gray-700 bg-white bg-opacity-90 p-4 rounded-md shadow w-fit">
                    No signature products available at the moment.
                </p>
            @else
                <div class="flex overflow-x-auto space-x-6 pb-2 scrollbar-thin scrollbar-thumb-indigo-400">
                    @foreach($signatureProducts as $product)
                        <div 
                            class="min-w-[300px] bg-white bg-opacity-90 p-4 rounded-xl shadow hover:shadow-xl transform hover:scale-105 transition cursor-pointer flex-shrink-0"
                            @click="selectedProduct = {
                                id: '{{ $product->id }}',
                                image: '{{ asset($product->image) }}',
                                name: @js($product->name),
                                price: '{{ $product->price }}'
                            }"
                        >
                            @if($product->image)
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full max-h-48 object-contain rounded-md mb-3">
                            @endif
                            <h4 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h4>
                            <p class="text-indigo-600 font-bold mt-2">₹{{ $product->price }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Other Products --}}
        <div>
            <h3 class="text-2xl font-semibold text-indigo-600 mb-6">More Products</h3>
            @if($otherProducts->isEmpty())
                <p class="text-gray-700 bg-white bg-opacity-90 p-4 rounded-md shadow w-fit">
                    No other products available at the moment.
                </p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                    @foreach($otherProducts as $product)
                        <div class="bg-white bg-opacity-90 p-5 rounded-xl shadow hover:shadow-xl transform hover:scale-105 transition cursor-pointer"
                             @click="selectedProduct = {
                                id: '{{ $product->id }}',
                                image: '{{ asset($product->image) }}',
                                name: @js($product->name),
                                price: '{{ $product->price }}'
                             }">
                            @if($product->image)
                                <img 
                                    src="{{ asset($product->image) }}" 
                                    alt="{{ $product->name }}" 
                                    class="w-full max-h-48 object-contain rounded-md mb-4">
                            @endif
                            <h4 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h4>
                            <p class="text-indigo-600 font-bold mt-2">₹{{ $product->price }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Modal --}}
        <div 
            x-show="selectedProduct"
            x-transition
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 overflow-y-auto"
            x-trap.noscroll="selectedProduct"
            x-cloak>
            
            <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6 relative"
                 @click.away="selectedProduct = null">
                
                <!-- Close Button -->
                <button class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-xl"
                        @click="selectedProduct = null">&times;</button>

                <template x-if="selectedProduct">
                    <div>
                        <!-- Product Image -->
                        <img :src="selectedProduct.image" alt="" class="w-full max-h-52 object-contain rounded-md mb-4">

                        <!-- Product Name -->
                        <h3 class="text-xl font-semibold text-gray-800" x-text="selectedProduct.name"></h3>

                        <!-- Price -->
                        <p class="text-indigo-600 font-bold mt-2 text-lg">₹<span x-text="selectedProduct.price"></span></p>

                        <!-- Add to Cart & Wishlist -->
                        <div class="mt-6 flex space-x-3">
                            <!-- Add to Cart -->
                            <form method="POST" :action="`/cart/${selectedProduct.id}`" class="w-1/2">
                                @csrf
                                <button type="submit"
                                    class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">
                                    Add to Cart
                                </button>
                            </form>

                            <!-- Add to Wishlist -->
                            <form method="POST" :action="`/wishlist/${selectedProduct.id}`" class="w-1/2">
                                @csrf
                                <button type="submit"
                                    class="w-full bg-pink-500 text-white py-2 rounded-lg hover:bg-pink-600 transition">
                                    Wishlist
                                </button>
                            </form>
                        </div>
                    </div>
                </template>
            </div>
        </div>

    </div>
</div>
@endsection

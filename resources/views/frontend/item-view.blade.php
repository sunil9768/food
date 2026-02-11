@extends('layouts.frontend')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4">
        <!-- Breadcrumb -->
        <nav class="mb-8">
            <div class="flex items-center space-x-2 text-sm text-gray-600">
                <a href="{{ route('home') }}" class="hover:text-orange-600">Home</a>
                <span>/</span>
                @if($item->category)
                    <a href="{{ route('category.items', $item->category->slug) }}" class="hover:text-orange-600">{{ $item->category->name }}</a>
                    <span>/</span>
                @endif
                <span class="text-gray-800">{{ $item->name }}</span>
            </div>
        </nav>

        <div class="grid lg:grid-cols-2 gap-12">
            <!-- Product Images -->
            <div class="space-y-4">
                <div class="aspect-square bg-white rounded-2xl shadow-lg overflow-hidden">
                    @if($item->image)
                        <img src="@storageAsset($item->image)" alt="{{ $item->name }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-orange-400 to-red-500 flex items-center justify-center">
                            <span class="text-white text-8xl">🍽️</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Product Details -->
            <div class="space-y-6">
                <!-- Vendor Badge -->
                @if($item->vendor)
                    <div class="flex items-center space-x-2">
                        <span class="bg-orange-100 text-orange-800 text-sm font-medium px-3 py-1 rounded-full">
                            🏪 {{ $item->vendor->restaurant_name ?: $item->vendor->name }}
                        </span>
                        @if($item->category)
                            <span class="bg-gray-100 text-gray-700 text-sm px-3 py-1 rounded-full">
                                {{ $item->category->name }}
                            </span>
                        @endif
                    </div>
                @endif

                <!-- Product Title -->
                <div>
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $item->name }}</h1>
                    <div class="flex items-center space-x-4 text-sm text-gray-600">
                        <div class="flex items-center">
                            <span class="text-yellow-400">★★★★★</span>
                            <span class="ml-1">(4.8)</span>
                        </div>
                        <span>•</span>
                        <span>🕒 15-20 mins prep</span>
                    </div>
                </div>

                <!-- Price -->
                <div class="flex items-baseline space-x-2">
                    <span class="text-4xl font-bold text-orange-600">₹{{ number_format($item->price) }}</span>
                    <span class="text-lg text-gray-500 line-through">₹{{ number_format($item->price * 1.2) }}</span>
                    <span class="bg-green-100 text-green-800 text-sm font-medium px-2 py-1 rounded">17% OFF</span>
                </div>

                <!-- Description -->
                <div class="prose prose-gray">
                    <p class="text-gray-700 leading-relaxed">
                        {{ $item->description ?: 'Delicious ' . $item->name . ' prepared with authentic spices and fresh ingredients. A perfect blend of traditional flavors that will tantalize your taste buds.' }}
                    </p>
                </div>

                <!-- Features -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-center space-x-2 text-sm text-gray-600">
                        <span class="text-green-500">✓</span>
                        <span>Fresh Ingredients</span>
                    </div>
                    <div class="flex items-center space-x-2 text-sm text-gray-600">
                        <span class="text-green-500">✓</span>
                        <span>No Preservatives</span>
                    </div>
                    <div class="flex items-center space-x-2 text-sm text-gray-600">
                        <span class="text-green-500">✓</span>
                        <span>Hygienic Preparation</span>
                    </div>
                    <div class="flex items-center space-x-2 text-sm text-gray-600">
                        <span class="text-green-500">✓</span>
                        <span>Hot & Fresh Delivery</span>
                    </div>
                </div>

                <!-- Quantity & Add to Cart -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-4">
                        <span class="text-lg font-medium text-gray-900">Quantity:</span>
                        <div class="flex items-center border-2 border-gray-200 rounded-lg">
                            <button onclick="decreaseQuantity()" class="px-4 py-2 text-gray-600 hover:bg-gray-100 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                </svg>
                            </button>
                            <span id="quantity" class="px-6 py-2 font-semibold text-lg">1</span>
                            <button onclick="increaseQuantity()" class="px-4 py-2 text-gray-600 hover:bg-gray-100 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex space-x-4">
                        <button onclick="addToCartFromView()" class="flex-1 bg-orange-500 text-white px-8 py-4 rounded-xl font-semibold text-lg hover:bg-orange-600 transition-colors duration-200 flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9M17 13v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6"></path>
                            </svg>
                            <span>Add to Cart</span>
                        </button>
                        <button class="px-6 py-4 border-2 border-orange-500 text-orange-500 rounded-xl hover:bg-orange-50 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Delivery Info -->
                <div class="bg-blue-50 rounded-xl p-6 space-y-3">
                    <h3 class="font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Delivery Information
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm text-gray-700">
                        <div class="flex items-center space-x-2">
                            <span class="text-green-500">🚚</span>
                            <span>Free delivery above ₹299</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-blue-500">⏰</span>
                            <span>Delivery in 25-30 mins</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-orange-500">🔥</span>
                            <span>Served hot & fresh</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-purple-500">💳</span>
                            <span>Cash on delivery available</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Items -->
        <div class="mt-16">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">You might also like</h2>
            <div class="grid md:grid-cols-4 gap-6">
                @php
                    $relatedItems = App\Models\MenuItem::where('is_active', true)
                        ->where('id', '!=', $item->id)
                        ->where('category_id', $item->category_id)
                        ->with(['vendor'])
                        ->take(4)
                        ->get();
                @endphp
                @foreach($relatedItems as $relatedItem)
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                    @if($relatedItem->image)
                        <img src="@storageAsset($relatedItem->image)" alt="{{ $relatedItem->name }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-orange-400 to-red-500 flex items-center justify-center">
                            <span class="text-white text-3xl">🍽️</span>
                        </div>
                    @endif
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-900 mb-2">{{ $relatedItem->name }}</h3>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-orange-600">₹{{ number_format($relatedItem->price) }}</span>
                            <a href="{{ route('item.view', $relatedItem->id) }}" class="bg-orange-500 text-white px-3 py-1 rounded-lg text-sm hover:bg-orange-600 transition">
                                View
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
let quantity = 1;

function increaseQuantity() {
    quantity++;
    document.getElementById('quantity').textContent = quantity;
}

function decreaseQuantity() {
    if (quantity > 1) {
        quantity--;
        document.getElementById('quantity').textContent = quantity;
    }
}

function addToCartFromView() {
    addToCart({{ $item->id }}, '{{ $item->name }}', {{ $item->price }}, quantity);
}
</script>
@endsection
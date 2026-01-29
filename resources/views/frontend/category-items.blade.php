@extends('layouts.frontend')

@section('title', $category->name . ' - Desi Delights')

@section('content')
    <!-- Category Header -->
    <section class="py-16 bg-gradient-to-r from-orange-400 to-red-500 text-white">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-5xl font-bold mb-4">{{ $category->name }}</h1>
            <p class="text-xl">{{ $category->description ?: 'Delicious ' . $category->name . ' items' }}</p>
            <p class="text-lg mt-2">{{ $menuItems->total() }} items available</p>
        </div>
    </section>

    <!-- Menu Items -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($menuItems as $item)
                <div class="bg-white rounded-xl p-4 shadow-lg hover:shadow-xl transition">
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="w-full h-40 object-cover rounded-lg mb-3">
                    @else
                        <div class="w-full h-40 bg-gray-200 rounded-lg mb-3 flex items-center justify-center">
                            <span class="text-gray-400 text-xl">🍽️</span>
                        </div>
                    @endif
                    
                    <h4 class="text-lg font-bold text-gray-800 mb-2">{{ $item->name }}</h4>
                    
                    @if($item->description)
                        <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $item->description }}</p>
                    @endif
                    
                    @if($item->vendor)
                        <div class="mb-3">
                            <span class="bg-orange-100 text-orange-800 text-xs px-2 py-1 rounded-full">{{ $item->vendor->restaurant_name ?: $item->vendor->name }}</span>
                        </div>
                    @endif
                    
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-bold text-orange-600">₹{{ number_format($item->price) }}</span>
                        <button onclick="addToCart({{ $item->id }}, '{{ $item->name }}', {{ $item->price }})" class="bg-orange-500 text-white px-3 py-1 rounded-full hover:bg-orange-600 transition text-sm">
                            Add
                        </button>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-16">
                    <h2 class="text-2xl font-bold text-gray-600 mb-4">No Items Available!</h2>
                    <p class="text-gray-500">No items found in this category.</p>
                    <a href="{{ route('home') }}" class="inline-block mt-6 bg-orange-500 text-white px-6 py-3 rounded-full hover:bg-orange-600 transition">
                        Back to Home
                    </a>
                </div>
                @endforelse
            </div>
            
            <!-- Pagination Links -->
            <div class="mt-8 flex justify-center">
                {{ $menuItems->links() }}
            </div>
        </div>
    </section>
@endsection
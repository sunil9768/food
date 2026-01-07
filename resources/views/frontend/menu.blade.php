@extends('layouts.frontend')

@section('title', 'Menu - Desi Delights')

@section('content')
    <!-- Menu Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold text-center text-gray-800 mb-12">Our Menu</h1>
            
            @forelse($categories as $category)
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-curry mb-8 border-b-2 border-curry pb-2">
                    {{ $category->name }}
                    <span class="text-lg text-gray-500 font-normal">({{ $category->menuItems->count() }} items)</span>
                </h2>
                
                @if($category->menuItems->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($category->menuItems as $item)
                    <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition">
                        @if($item->image)
                            <img src="{{ asset($item->image) }}" alt="{{ $item->name }}" class="w-full h-48 object-cover rounded-lg mb-4">
                        @else
                            <div class="w-full h-48 bg-gray-200 rounded-lg mb-4 flex items-center justify-center">
                                <span class="text-gray-400">🍽️</span>
                            </div>
                        @endif
                        
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $item->name }}</h3>
                        
                        @if($item->description)
                        <p class="text-gray-600 mb-4">{{ $item->description }}</p>
                        @endif
                        
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-curry">₹{{ number_format($item->price) }}</span>
                            <button onclick="addToCart({{ $item->id }}, '{{ $item->name }}', {{ $item->price }})" class="bg-curry text-white px-4 py-2 rounded-full hover:bg-orange-600 transition">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-gray-500 text-center py-8">No items available in this category.</p>
                @endif
            </div>
            @empty
            <div class="text-center py-16">
                <h2 class="text-2xl font-bold text-gray-600 mb-4">Menu Coming Soon!</h2>
                <p class="text-gray-500">We're working on adding delicious items to our menu.</p>
                <a href="{{ route('home') }}" class="inline-block mt-6 bg-curry text-white px-6 py-3 rounded-full hover:bg-orange-600 transition">
                    Back to Home
                </a>
            </div>
            @endforelse
        </div>
    </section>
@endsection
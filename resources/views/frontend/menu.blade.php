@extends('layouts.frontend')

@section('title', 'All Menu Items - Desi Delights')

@section('content')
    <!-- Menu Section -->
    <section class="py-4 md:py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-2xl md:text-4xl font-bold text-center text-gray-800 mb-6 md:mb-12">All Menu Items</h1>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-6">
                @forelse($menuItems as $item)
                <div class="bg-white rounded-xl p-3 md:p-4 shadow-lg hover:shadow-xl transition">
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="w-full h-32 md:h-40 object-cover rounded-lg mb-2 md:mb-3">
                    @else
                        <div class="w-full h-32 md:h-40 bg-gray-200 rounded-lg mb-2 md:mb-3 flex items-center justify-center">
                            <span class="text-gray-400 text-xl">🍽️</span>
                        </div>
                    @endif
                    
                    <h4 class="text-sm md:text-lg font-bold text-gray-800 mb-1 md:mb-2 line-clamp-2">{{ $item->name }}</h4>
                    
                    @if($item->description)
                        <p class="text-gray-600 text-xs md:text-sm mb-2 md:mb-3 line-clamp-2 hidden md:block">{{ $item->description }}</p>
                    @endif
                    
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-2 md:mb-3 space-y-1 md:space-y-0">
                        @if($item->vendor)
                            <span class="bg-orange-100 text-orange-800 text-xs px-2 py-1 rounded-full truncate">{{ $item->vendor->restaurant_name ?: $item->vendor->name }}</span>
                        @endif
                        @if($item->category)
                            <span class="bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded-full">{{ $item->category->name }}</span>
                        @endif
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <span class="text-sm md:text-lg font-bold text-orange-600">₹{{ number_format($item->price) }}</span>
                        <button onclick="addToCart({{ $item->id }}, '{{ $item->name }}', {{ $item->price }})" class="bg-orange-500 text-white px-2 md:px-3 py-1 rounded-full hover:bg-orange-600 transition text-xs md:text-sm">
                            Add
                        </button>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12 md:py-16">
                    <h2 class="text-xl md:text-2xl font-bold text-gray-600 mb-4">No Menu Items Available!</h2>
                    <p class="text-gray-500">We're working on adding menu items to our platform.</p>
                    <a href="{{ route('home') }}" class="inline-block mt-6 bg-orange-500 text-white px-6 py-3 rounded-full hover:bg-orange-600 transition">
                        Back to Home
                    </a>
                </div>
                @endforelse
            </div>
            
            <!-- Pagination Links -->
            <div class="mt-6 md:mt-8 flex justify-center">
                {{ $menuItems->links() }}
            </div>
        </div>
    </section>
@endsection
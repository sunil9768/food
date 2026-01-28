@extends('layouts.frontend')

@section('title', 'Restaurants - Desi Delights')

@section('content')
    <!-- Menu Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold text-center text-gray-800 mb-12">Choose Your Restaurant</h1>
            
            <div class="row">
                @forelse($vendors as $vendor)
                <div class="col-md-4 mb-4">
                    <a href="{{ route('vendor.menu.view', $vendor->id) }}" class="block bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden text-decoration-none">
                        @if($vendor->banner_image)
                            <div class="h-48 bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $vendor->banner_image) }}')"></div>
                        @else
                            <div class="h-48 bg-gradient-to-r from-orange-500 to-red-500"></div>
                        @endif
                        <div class="p-4">
                            <div class="flex items-center mb-3">
                                <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-500 rounded-full flex items-center justify-center text-white text-lg font-bold mr-3">
                                    🍛
                                </div>
                                <div class="flex-1">
                                    <h2 class="text-xl font-bold text-gray-800 mb-1">{{ $vendor->restaurant_name ?: $vendor->name }}</h2>
                                    <p class="text-gray-600 text-sm">{{ $vendor->menu_items_count }} items available</p>
                                </div>
                            </div>
                            <div class="text-sm text-gray-500 mb-3">
                                <div class="mb-1">⭐ 4.5 (120+ reviews)</div>
                                <div class="mb-1">🚚 25-30 mins</div>
                                <div>🍽️ Indian, Vegetarian</div>
                            </div>
                            <div class="flex justify-between items-center">
                                <div class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-semibold">
                                    Open Now
                                </div>
                                <p class="text-gray-500 text-xs">Free delivery</p>
                            </div>
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-12">
                    <div class="text-center py-16">
                        <h2 class="text-2xl font-bold text-gray-600 mb-4">No Restaurants Available!</h2>
                        <p class="text-gray-500">We're working on adding restaurants to our platform.</p>
                        <a href="{{ route('home') }}" class="inline-block mt-6 bg-orange-500 text-white px-6 py-3 rounded-full hover:bg-orange-600 transition">
                            Back to Home
                        </a>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
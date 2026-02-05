@extends('layouts.frontend')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-saffron to-curry text-white py-20">
        <div class="container mx-auto px-4 flex flex-col lg:flex-row items-center">
            <div class="lg:w-1/2 mb-10 lg:mb-0">
                <h2 class="text-5xl font-bold mb-6">Fresh Roti & Sabji<br>Delivered Hot!</h2>
                <p class="text-xl mb-8">Experience authentic Indian flavors with our signature Aalu Sabji and freshly made rotis, delivered straight to your doorstep.</p>
                <button class="bg-white text-curry px-8 py-4 rounded-full text-lg font-semibold hover:bg-gray-100 transition shadow-lg">
                    Order Aalu Sabji Special - ₹149
                </button>
            </div>
            <div class="lg:w-1/2">
                <div class="bg-white rounded-2xl p-8 shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=500&h=400&fit=crop" 
                         alt="Delicious Aalu Sabji with Roti" 
                         class="w-full h-80 object-cover rounded-xl">
                    <div class="mt-4 text-center">
                        <h3 class="text-2xl font-bold text-gray-800">Aalu Sabji Special</h3>
                        <p class="text-gray-600">Spiced potatoes with fresh roti</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Restaurant Marketing Section -->
    <section class="py-16 bg-gradient-to-r from-green-50 to-blue-50">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-4xl font-bold text-gray-800 mb-6">🍴 Partner with Desi Delights</h2>
                <p class="text-xl text-gray-600 mb-8">Join thousands of restaurants growing their business with us</p>
                
                <div class="grid md:grid-cols-3 gap-8 mb-12">
                    <div class="bg-white rounded-xl p-6 shadow-lg">
                        <div class="text-4xl mb-4">🎆</div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">100% FREE Registration</h3>
                        <p class="text-gray-600">No setup fees, no monthly charges. Start selling immediately!</p>
                    </div>
                    <div class="bg-white rounded-xl p-6 shadow-lg">
                        <div class="text-4xl mb-4">💰</div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Increase Your Revenue</h3>
                        <p class="text-gray-600">Reach more customers and boost your sales by up to 40%</p>
                    </div>
                    <div class="bg-white rounded-xl p-6 shadow-lg">
                        <div class="text-4xl mb-4">🚚</div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Easy Order Management</h3>
                        <p class="text-gray-600">Simple dashboard to manage orders, menu, and track earnings</p>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl p-8 shadow-xl">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Ready to Get Started?</h3>
                    <p class="text-gray-600 mb-6">Register your restaurant today and start listing your delicious items on our platform - completely FREE!</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('vendor.register') }}" class="bg-gradient-to-r from-green-500 to-blue-500 text-white px-8 py-3 rounded-full hover:from-green-600 hover:to-blue-600 transition text-lg font-semibold">
                            Register Your Restaurant FREE
                        </a>
                        <a href="#contact" class="border-2 border-gray-300 text-gray-700 px-8 py-3 rounded-full hover:border-gray-400 transition text-lg font-semibold">
                            Learn More
                        </a>
                    </div>
                    <p class="text-sm text-gray-500 mt-4">✨ Join 10+ restaurants already partnered with us</p>
                </div>
            </div>
        </div>
    </section>

    
 <!-- All Restaurants -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center text-gray-800 mb-12">All Restaurants</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($restaurants as $restaurant)
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition overflow-hidden">
                    @if($restaurant->banner_image)
                        <img src="@storageAsset($restaurant->banner_image)" alt="{{ $restaurant->restaurant_name ?: $restaurant->name }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-to-r from-orange-400 to-red-500 flex items-center justify-center">
                            <span class="text-white text-4xl">🍛</span>
                        </div>
                    @endif
                    
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $restaurant->restaurant_name ?: $restaurant->name }}</h3>
                        <div class="flex items-center text-gray-600 mb-4">
                            <span class="mr-4">⭐ 4.5</span>
                            <span class="mr-4">🚚 25-30 mins</span>
                            <span>🍽️ {{ $restaurant->menu_items_count }} items</span>
                        </div>
                        
                        @if($restaurant->menuItems->count() > 0)
                        <div class="mb-4">
                            <h4 class="text-sm font-semibold text-gray-700 mb-2">Popular Items:</h4>
                            <div class="flex flex-wrap gap-1">
                                @foreach($restaurant->menuItems->take(3) as $item)
                                <span class="bg-orange-100 text-orange-800 text-xs px-2 py-1 rounded-full">{{ $item->name }}</span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        
                        <div class="flex justify-between items-center">
                            <span class="text-green-600 font-semibold">Open Now</span>
                            <a href="{{ route('vendor.menu.view', $restaurant->id) }}" class="bg-orange-500 text-white px-4 py-2 rounded-full hover:bg-orange-600 transition">
                                View Menu
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-8">
                    <p class="text-gray-500 text-lg">No restaurants available at the moment.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>
  <!-- Categories Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center text-gray-800 mb-12">Browse by Category</h2>
            <div class="grid md:grid-cols-4 lg:grid-cols-6 gap-6">
                @foreach($categories as $category)
                <a href="{{ route('category.items', $category->slug) }}" class="bg-orange-50 rounded-xl p-6 text-center hover:bg-orange-100 transition group">
                    <div class="text-4xl mb-3">
                        @switch($category->slug)
                            @case('soup')
                                🍲
                                @break
                            @case('starters')
                                🥗
                                @break
                            @case('rice-and-biryani')
                                🍚
                                @break
                            @case('noodles')
                                🍜
                                @break
                            @case('indian-breads')
                                🫓
                                @break
                            @case('accompaniment')
                                🥣
                                @break
                            @case('desserts')
                                🍰
                                @break
                            @case('main-course')
                                🍽️
                                @break
                            @case('sizzlers')
                                🔥
                                @break
                            @case('indian-curry-veg')
                                🥘
                                @break
                            @case('momos')
                                🥟
                                @break
                            @case('salads')
                                🥗
                                @break
                            @case('burgers')
                                🍔
                                @break
                            @case('pasta')
                                🍝
                                @break
                            @default
                                🍽️
                        @endswitch
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 group-hover:text-orange-600 transition">{{ $category->name }}</h3>
                    <p class="text-sm text-gray-600 mt-1">{{ $category->menu_items_count }} items</p>
                </a>
                @endforeach
            </div>
        </div>
    </section>
  

    <!-- Popular Dishes -->
    <section id="menu" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center text-gray-800 mb-12">Popular Dishes</h2>
            <div class="grid md:grid-cols-3 gap-8">
                @forelse($popularItems as $item)
                <div class="bg-orange-50 rounded-xl p-6 shadow-lg hover:shadow-xl transition">
                    @if($item->image)
                        <img src="@storageAsset($item->image)" alt="{{ $item->name }}" class="w-full h-48 object-cover rounded-lg mb-4">
                    @else
                        <div class="w-full h-48 bg-gray-200 rounded-lg mb-4 flex items-center justify-center">
                            <span class="text-gray-400 text-2xl">🍽️</span>
                        </div>
                    @endif
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-bold text-gray-800">{{ $item->name }}</h3>
                        @if($item->vendor)
                            <span class="bg-orange-200 text-orange-800 text-xs px-2 py-1 rounded-full">🍛 {{ $item->vendor->restaurant_name ?: $item->vendor->name }}</span>
                        @endif
                    </div>
                    <p class="text-gray-600 mb-4">{{ $item->description ?: 'Delicious ' . $item->name }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-2xl font-bold text-orange-600">₹{{ number_format($item->price) }}</span>
                        <button onclick="addToCart({{ $item->id }}, '{{ $item->name }}', {{ $item->price }})" class="bg-orange-500 text-white px-4 py-2 rounded-full hover:bg-orange-600 transition">Add to Cart</button>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-8">
                    <p class="text-gray-500 text-lg">No menu items available at the moment.</p>
                </div>
                @endforelse
            </div>
            
            @if($popularItems->count() > 0)
            <div class="text-center mt-12">
                <a href="{{ route('menu') }}" class="bg-curry text-white px-8 py-3 rounded-full hover:bg-orange-600 transition text-lg font-semibold">
                    View Full Menu
                </a>
            </div>
            @endif
        </div>
    </section>

   

    <!-- Customer Testimonials -->
    <section id="testimonials" class="py-16 bg-gradient-to-r from-orange-100 to-yellow-100">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center text-gray-800 mb-12">What Our Customers Say</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl p-6 shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-curry rounded-full flex items-center justify-center text-white font-bold">P</div>
                        <div class="ml-4">
                            <h4 class="font-bold text-gray-800">Priya Sharma</h4>
                            <div class="text-yellow-500">★★★★★</div>
                        </div>
                    </div>
                    <p class="text-gray-600">"The aalu sabji reminds me of my mom's cooking! Fresh rotis and perfect spices. Will order again!"</p>
                </div>
                
                <div class="bg-white rounded-xl p-6 shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-curry rounded-full flex items-center justify-center text-white font-bold">R</div>
                        <div class="ml-4">
                            <h4 class="font-bold text-gray-800">Rahul Kumar</h4>
                            <div class="text-yellow-500">★★★★★</div>
                        </div>
                    </div>
                    <p class="text-gray-600">"Fast delivery and authentic taste. The dal tadka was exceptional. Highly recommended!"</p>
                </div>
                
                <div class="bg-white rounded-xl p-6 shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-curry rounded-full flex items-center justify-center text-white font-bold">A</div>
                        <div class="ml-4">
                            <h4 class="font-bold text-gray-800">Anita Patel</h4>
                            <div class="text-yellow-500">★★★★★</div>
                        </div>
                    </div>
                    <p class="text-gray-600">"Best Indian food delivery in the city! The paneer butter masala was creamy and delicious."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="bg-curry text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-6">Hungry? Order Now!</h2>
            <p class="text-xl mb-8">Get your favorite Indian dishes delivered hot and fresh in 30 minutes</p>
            <button class="bg-white text-curry px-8 py-4 rounded-full text-lg font-semibold hover:bg-gray-100 transition shadow-lg">
                Start Your Order
            </button>
        </div>
    </section>
@endsection
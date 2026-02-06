@extends('layouts.frontend')

@section('content')
    <!-- Vendor Registration Hero Section -->
    <section class="bg-gradient-to-r from-green-600 to-blue-600 text-white py-20">
        <div class="container mx-auto px-4 flex flex-col lg:flex-row items-center">
            <div class="lg:w-1/2 mb-10 lg:mb-0">
                <h2 class="text-5xl font-bold mb-6">🏪 Grow Your Restaurant<br>Business Online!</h2>
                <p class="text-xl mb-8">Join Desi Delights platform and reach thousands of hungry customers. Register your restaurant for FREE and start earning more today!</p>
                <a href="{{ route('vendor.register') }}" class="bg-white text-green-600 px-8 py-4 rounded-full text-lg font-semibold hover:bg-gray-100 transition shadow-lg inline-block">
                    Register Your Restaurant FREE
                </a>
            </div>
            <div class="lg:w-1/2">
                <div class="bg-white rounded-2xl p-8 shadow-2xl">
                    <div class="text-center mb-6">
                        <div class="text-6xl mb-4">🍽️</div>
                        <h3 class="text-2xl font-bold text-gray-800">Partner Benefits</h3>
                    </div>
                    <div class="space-y-4 text-gray-700">
                        <div class="flex items-center">
                            <span class="text-green-500 text-xl mr-3">✅</span>
                            <span>Zero registration fees</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-green-500 text-xl mr-3">✅</span>
                            <span>Easy menu management</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-green-500 text-xl mr-3">✅</span>
                            <span>Real-time order tracking</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-green-500 text-xl mr-3">✅</span>
                            <span>Increase revenue by 40%</span>
                        </div>
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
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-100 rounded-2xl p-8 shadow-xl hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 border border-blue-200">
                        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                            <div class="text-3xl text-white">🎆</div>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4 text-center">100% FREE Registration</h3>
                        <p class="text-gray-600 text-center leading-relaxed">No setup fees, no monthly charges. Start selling immediately and grow your business!</p>
                        <div class="mt-6 text-center">
                            <span class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-semibold">₹0 Setup Cost</span>
                        </div>
                    </div>
                    <div class="bg-gradient-to-br from-green-50 to-emerald-100 rounded-2xl p-8 shadow-xl hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 border border-green-200">
                        <div class="bg-gradient-to-r from-green-500 to-emerald-600 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                            <div class="text-3xl text-white">💰</div>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4 text-center">Increase Your Revenue</h3>
                        <p class="text-gray-600 text-center leading-relaxed">Reach more customers and boost your sales by up to 40% with our platform!</p>
                        <div class="mt-6 text-center">
                            <span class="bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-semibold">+40% Revenue</span>
                        </div>
                    </div>
                    <div class="bg-gradient-to-br from-purple-50 to-violet-100 rounded-2xl p-8 shadow-xl hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 border border-purple-200">
                        <div class="bg-gradient-to-r from-purple-500 to-violet-600 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                            <div class="text-3xl text-white">🚚</div>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4 text-center">Easy Order Management</h3>
                        <p class="text-gray-600 text-center leading-relaxed">Simple dashboard to manage orders, menu, and track earnings effortlessly!</p>
                        <div class="mt-6 text-center">
                            <span class="bg-purple-100 text-purple-800 px-4 py-2 rounded-full text-sm font-semibold">Smart Dashboard</span>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-r from-orange-50 to-red-50 rounded-3xl p-10 shadow-2xl border border-orange-200">
                    <div class="text-center mb-8">
                        <div class="bg-gradient-to-r from-orange-500 to-red-500 w-20 h-20 rounded-full flex items-center justify-center mb-6 mx-auto">
                            <div class="text-4xl text-white">🚀</div>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-800 mb-4">Ready to Get Started?</h3>
                        <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">Register your restaurant today and start listing your delicious items on our platform - completely FREE!</p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                        <a href="{{ route('vendor.register') }}" class="bg-gradient-to-r from-green-500 to-blue-500 text-white px-10 py-4 rounded-full hover:from-green-600 hover:to-blue-600 transition-all duration-300 text-xl font-bold shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            🏪 Register Your Restaurant FREE
                        </a>
                        <a href="#contact" class="border-2 border-gray-400 text-gray-700 px-8 py-4 rounded-full hover:border-gray-600 hover:bg-gray-50 transition-all duration-300 text-lg font-semibold">
                            📞 Learn More
                        </a>
                    </div>
                    <div class="mt-8 text-center">
                        <div class="flex justify-center items-center gap-4 text-sm text-gray-600">
                            <span class="bg-white px-4 py-2 rounded-full shadow">✨ Join 10+ restaurants</span>
                            <span class="bg-white px-4 py-2 rounded-full shadow">⚡ Quick Setup</span>
                            <span class="bg-white px-4 py-2 rounded-full shadow">🎯 Instant Results</span>
                        </div>
                    </div>
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
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <button class="bg-white text-curry px-8 py-4 rounded-full text-lg font-semibold hover:bg-gray-100 transition shadow-lg">
                    Start Your Order
                </button>
                <a href="http://food.arunil.in/public/food.apk" class="bg-green-600 text-white px-6 py-3 rounded-full hover:bg-green-700 transition text-lg font-semibold flex items-center gap-2" download>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    Download APK
                </a>
            </div>
        </div>
    </section>
@endsection
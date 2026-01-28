@extends('layouts.frontend')

@section('title', $vendor->restaurant_name ?: $vendor->name . ' - Menu')

@section('content')
    <!-- Vendor Header -->
    <section class="relative">
        @if($vendor->banner_image)
            <div class="h-64 bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $vendor->banner_image) }}')"></div>
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        @else
            <div class="h-64 bg-gradient-to-r from-orange-500 to-red-500"></div>
        @endif
        <div class="absolute inset-0 flex items-center">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-between text-white">
                    <div>
                        <h1 class="text-4xl font-bold mb-2">🍛 {{ $vendor->restaurant_name ?: $vendor->name }}</h1>
                        <div class="flex items-center text-orange-100 space-x-6">
                            <span>⭐ 4.5 (120+ reviews)</span>
                            <span>🚚 25-30 mins</span>
                            <span>🍽️ Indian, Vegetarian</span>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="bg-green-500 text-white px-4 py-2 rounded-full font-semibold mb-2">
                            Open Now
                        </div>
                        <p class="text-orange-100">Free delivery on orders above ₹299</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Menu Items -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Menu ({{ $vendor->menuItems->count() }} items)</h2>
                <div class="flex items-center space-x-4">
                    <!-- Grid View Options -->
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-gray-600">View:</span>
                        <button onclick="changeGrid(3)" id="grid-3" class="grid-btn px-2 py-1 text-xs border rounded hover:bg-gray-100">3</button>
                        <button onclick="changeGrid(4)" id="grid-4" class="grid-btn px-2 py-1 text-xs border rounded bg-orange-100 border-orange-300">4</button>
                        <button onclick="changeGrid(5)" id="grid-5" class="grid-btn px-2 py-1 text-xs border rounded hover:bg-gray-100">5</button>
                    </div>
                    
                    <!-- Price Filter -->
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-gray-600">Sort:</span>
                        <select onchange="sortItems(this.value)" class="text-sm border rounded px-2 py-1">
                            <option value="default">Default</option>
                            <option value="price-low">Price: Low to High</option>
                            <option value="price-high">Price: High to Low</option>
                        </select>
                    </div>
                    
                    <a href="{{ route('menu') }}" class="text-orange-600 hover:text-orange-700 font-medium">
                        ← Back to Restaurants
                    </a>
                </div>
            </div>
            
            @if($vendor->menuItems->count() > 0)
                @php
                    $groupedItems = $vendor->menuItems->groupBy('category.name');
                    $categories = $groupedItems->keys();
                @endphp
                
                <div class="flex gap-8">
                    <!-- Category Sidebar -->
                    <div class="w-64 flex-shrink-0">
                        <div class="bg-white rounded-lg shadow-lg p-6 sticky top-4">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Categories</h3>
                            <nav class="space-y-2">
                                @foreach($categories as $categoryName)
                                    <button onclick="showCategory('{{ Str::slug($categoryName) }}')" class="category-tab w-full text-left px-4 py-2 rounded-lg font-medium {{ $loop->first ? 'active bg-orange-500 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                                        {{ $categoryName }}
                                        <span class="text-sm {{ $loop->first ? 'text-orange-100' : 'text-gray-500' }} block">({{ $groupedItems[$categoryName]->count() }} items)</span>
                                    </button>
                                @endforeach
                            </nav>
                        </div>
                    </div>
                    
                    <!-- Menu Content -->
                    <div class="flex-1">
                        @foreach($groupedItems as $categoryName => $items)
                            <div class="category-section mb-12" data-category="{{ Str::slug($categoryName) }}" style="{{ $loop->first ? 'display: block;' : 'display: none;' }}">
                                <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b-2 border-orange-500 pb-2">
                                    {{ $categoryName }}
                                    <span class="text-lg text-gray-500 font-normal">({{ $items->count() }} items)</span>
                                </h3>
                                
                                <div id="menu-grid" class="grid md:grid-cols-3 lg:grid-cols-4 gap-4">
                                    @foreach($items as $item)
                                        <div class="menu-item bg-white rounded-xl p-4 shadow-lg hover:shadow-xl transition" data-price="{{ $item->price }}">
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
                                            
                                            <div class="flex justify-between items-center">
                                                <span class="text-lg font-bold text-orange-600">₹{{ number_format($item->price) }}</span>
                                                <button onclick="addToCart({{ $item->id }}, '{{ $item->name }}', {{ $item->price }})" class="bg-orange-500 text-white px-3 py-1 rounded-full hover:bg-orange-600 transition text-sm">
                                                    Add
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="text-center py-16">
                    <h3 class="text-2xl font-bold text-gray-600 mb-4">No Menu Items Available</h3>
                    <p class="text-gray-500">This restaurant is still setting up their menu.</p>
                </div>
            @endif
        </div>
    </section>

    <script>
        function changeGrid(columns) {
            const grids = document.querySelectorAll('#menu-grid');
            const buttons = document.querySelectorAll('.grid-btn');
            
            // Update grid classes
            grids.forEach(grid => {
                grid.className = `grid gap-4`;
                if (columns === 3) {
                    grid.classList.add('md:grid-cols-2', 'lg:grid-cols-3');
                } else if (columns === 4) {
                    grid.classList.add('md:grid-cols-3', 'lg:grid-cols-4');
                } else if (columns === 5) {
                    grid.classList.add('md:grid-cols-4', 'lg:grid-cols-5');
                }
            });
            
            // Update button styles
            buttons.forEach(btn => {
                btn.classList.remove('bg-orange-100', 'border-orange-300');
                btn.classList.add('hover:bg-gray-100');
            });
            
            document.getElementById(`grid-${columns}`).classList.add('bg-orange-100', 'border-orange-300');
            document.getElementById(`grid-${columns}`).classList.remove('hover:bg-gray-100');
        }
        
        function sortItems(sortType) {
            const sections = document.querySelectorAll('.category-section');
            
            sections.forEach(section => {
                const grid = section.querySelector('#menu-grid');
                if (!grid) return;
                
                const items = Array.from(grid.querySelectorAll('.menu-item'));
                
                if (sortType === 'price-low') {
                    items.sort((a, b) => parseFloat(a.dataset.price) - parseFloat(b.dataset.price));
                } else if (sortType === 'price-high') {
                    items.sort((a, b) => parseFloat(b.dataset.price) - parseFloat(a.dataset.price));
                }
                
                // Re-append sorted items
                items.forEach(item => grid.appendChild(item));
            });
        }
        

        
        function showCategory(categorySlug) {
            // Hide all category sections
            document.querySelectorAll('.category-section').forEach(section => {
                section.style.display = 'none';
            });
            
            // Show selected category section
            const targetSection = document.querySelector(`[data-category="${categorySlug}"]`);
            if (targetSection) {
                targetSection.style.display = 'block';
            }
            
            // Update sidebar button styles
            document.querySelectorAll('.category-tab').forEach(tab => {
                tab.classList.remove('active', 'bg-orange-500', 'text-white');
                tab.classList.add('text-gray-700', 'hover:bg-gray-100');
            });
            
            // Activate clicked button
            event.target.classList.add('active', 'bg-orange-500', 'text-white');
            event.target.classList.remove('text-gray-700', 'hover:bg-gray-100');
        }
    </script>
@endsection
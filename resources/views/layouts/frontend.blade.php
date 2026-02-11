<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Order authentic Indian cuisine from multiple restaurants. Fast delivery, fresh food delivered to your doorstep!">
    <title>@yield('title', 'Desi Delights - Authentic Indian Food Delivery')</title>
    <link rel="manifest" href="https://food.arunil.in/public/manifest.json">
    <meta name="theme-color" content="#FF6B35">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="Desi Delights">
    <link rel="apple-touch-icon" href="https://food.arunil.in/public/android/android-launchericon-144-144.png">
    <link rel="apple-touch-icon" sizes="48x48" href="https://food.arunil.in/public/android/android-launchericon-48-48.png">
    <link rel="apple-touch-icon" sizes="72x72" href="https://food.arunil.in/public/android/android-launchericon-72-72.png">
    <link rel="icon" type="image/png" sizes="96x96" href="https://food.arunil.in/public/android/android-launchericon-96-96.png">
    <link rel="icon" type="image/png" sizes="144x144" href="https://food.arunil.in/public/android/android-launchericon-144-144.png">
     <link rel="icon" type="image/png" sizes="512x512" href="https://food.arunil.in/public/android/android-launchericon-512-512.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'saffron': '#FF9933',
                        'curry': '#FF6B35',
                        'turmeric': '#FDB462',
                        'primary': '#FF6B35',
                        'secondary': '#1f2937'
                    },
                    spacing: {
                        '18': '4.5rem',
                        '88': '22rem'
                    }
                }
            }
        }
    </script>
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .app-container {
            padding-bottom: 80px; /* Space for bottom nav */
        }
        @media (min-width: 768px) {
            .app-container {
                padding-bottom: 0;
            }
        }
        .bottom-nav {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }
        .mobile-header {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }
    </style>
</head>
<body class="bg-orange-50">
    <!-- Mobile Header -->
    <header class="mobile-header fixed top-0 left-0 right-0 z-50 md:relative md:bg-white md:shadow-md">
        <div class="px-4 py-3 md:container md:mx-auto">
            <div class="flex items-center space-x-3 md:justify-between">
                <!-- Logo -->
                <div class="flex items-center flex-shrink-0">
                    <a href="{{ route('home') }}" class="text-lg md:text-2xl font-bold text-curry">🍛</a>
                </div>
                
                <!-- Search Bar -->
                <div class="flex-1 max-w-md md:max-w-lg">
                    <div class="relative">
                        <input type="text" id="searchInput" placeholder="Search for dishes, restaurants..." class="w-full px-4 py-2 pl-10 pr-4 text-sm bg-gray-100 border-0 rounded-full focus:outline-none focus:ring-2 focus:ring-curry focus:bg-white">
                        <svg class="absolute left-3 top-2.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
                
                <!-- Desktop navigation -->
                <nav class="hidden md:flex space-x-6">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-curry">Home</a>
                    <a href="{{ route('menu') }}" class="text-gray-700 hover:text-curry">Menu</a>
                      <a href="{{ route('partner') }}" class="text-gray-700 hover:text-curry">Partner </a>
                    <a href="{{ route('cart.view') }}" class="text-gray-700 hover:text-curry relative">
                        Cart
                        <span id="cartCount" class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center hidden">0</span>
                    </a>
                    <a href="#testimonials" class="text-gray-700 hover:text-curry">Reviews</a>
                    <a href="#contact" class="text-gray-700 hover:text-curry">Contact</a>
                </nav>
                
                <!-- Desktop auth buttons -->
                <div class="hidden md:flex items-center space-x-4">
                    @auth
                        <span class="text-gray-600 text-sm">Hi, {{ Auth::user()->name }}</span>
                        @if(Auth::user()->hasRole('user'))
                            <a href="{{ route('user.dashboard') }}" class="text-gray-700 hover:text-curry text-sm">My Account</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-curry text-sm">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-curry text-sm">Login</a>
                        <a href="{{ route('register') }}" class="bg-curry text-white px-3 py-2 rounded hover:bg-orange-600 text-sm">Register</a>
                        <a href="{{ route('vendor.register') }}" class="bg-green-600 text-white px-3 py-2 rounded hover:bg-green-700 text-sm">Partner with Us</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="app-container pt-16 md:pt-0">
        @yield('content')
    </main>
    
    <!-- Bottom Navigation (Mobile Only) -->
    <nav class="bottom-nav fixed bottom-0 left-0 right-0 md:hidden z-40 border-t border-gray-200">
        <div class="flex items-center justify-around py-2">
            <a href="{{ route('home') }}" class="flex flex-col items-center py-2 px-2 text-xs {{ request()->routeIs('home') ? 'text-curry' : 'text-gray-600' }}">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span>Home</span>
            </a>
            
            <a href="{{ route('menu') }}" class="flex flex-col items-center py-2 px-2 text-xs {{ request()->routeIs('menu') ? 'text-curry' : 'text-gray-600' }}">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                <span>Menu</span>
            </a>
            
            <a href="{{ route('cart.view') }}" class="flex flex-col items-center py-2 px-2 text-xs {{ request()->routeIs('cart.view') ? 'text-curry' : 'text-gray-600' }} relative">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9M17 13v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6"></path>
                </svg>
                <span>Cart</span>
                <span id="cartCountBottom" class="absolute -top-1 right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center hidden">0</span>
            </a>
            
            @guest
                <a href="{{ route('register') }}" class="flex flex-col items-center py-2 px-2 text-xs text-gray-600">
                    <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    <span>Register</span>
                </a>
            @else
                @if(Auth::user()->hasRole('user'))
                    <a href="{{ route('user.dashboard') }}" class="flex flex-col items-center py-2 px-2 text-xs {{ request()->routeIs('user.*') ? 'text-curry' : 'text-gray-600' }}">
                        <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span>Account</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="flex flex-col items-center py-2 px-2 text-xs text-gray-600">
                        <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        <span>Login</span>
                    </a>
                @endif
            @endguest
            
            <a href="{{ route('vendor.register') }}" class="flex flex-col items-center py-2 px-2 text-xs text-gray-600">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H3m2 0h4M9 7h6m-6 4h6m-6 4h6"></path>
                </svg>
                <span>Partner</span>
            </a>
        </div>
    </nav>

    <!-- Footer -->
    <footer id="contact" class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">🍛 Desi Delights</h3>
                    <p class="text-gray-400">Authentic Indian cuisine delivered fresh to your doorstep</p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Contact Info</h4>
                    <p class="text-gray-400">📞 {{ $settings['contact_phone'] ?? '+91 98765 43210' }}</p>
                    <p class="text-gray-400">📧 {{ $settings['contact_email'] ?? 'orders@desidelights.com' }}</p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Delivery Hours</h4>
                    <p class="text-gray-400">Mon-Sun: {{ date('g:i A', strtotime($settings['opening_time'] ?? '11:00')) }} - {{ date('g:i A', strtotime($settings['closing_time'] ?? '23:00')) }}</p>
                    <p class="text-gray-400">Free delivery on orders above ₹{{ $settings['free_delivery_above'] ?? '299' }}</p>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2024 Desi Delights. All rights reserved.</p>
            </div>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    
    function updateCartCount() {
        const count = cart.reduce((total, item) => total + item.quantity, 0);
        const cartElements = [
            document.getElementById('cartCount'),
            document.getElementById('cartCountBottom')
        ];
        
        cartElements.forEach(element => {
            if (element) {
                if (count > 0) {
                    element.textContent = count;
                    element.classList.remove('hidden');
                } else {
                    element.classList.add('hidden');
                }
            }
        });
    }
    
    // Refresh CSRF token periodically
    setInterval(() => {
        fetch('/csrf-token')
            .then(response => response.json())
            .then(data => {
                document.querySelector('meta[name="csrf-token"]').setAttribute('content', data.csrf_token);
            })
            .catch(() => {});
    }, 300000); // Refresh every 5 minutes
    
    function addToCart(id, name, price) {
        const existingItem = cart.find(item => item.id === id);
        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cart.push({ id, name, price, quantity: 1 });
        }
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartCount();
        
        Swal.fire({
            icon: 'success',
            title: 'Added to Cart!',
            text: `${name} has been added to your cart`,
            timer: 1500,
            showConfirmButton: false
        });
    }
    
    // Initialize cart count on page load
    updateCartCount();
    
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif
    
    @if(session('clearCart'))
        // Clear cart after successful order
        localStorage.removeItem('cart');
        cart = [];
        updateCartCount();
    @endif
    
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ session('error') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif
    </script>
    
    @yield('scripts')
    
    <script>
    // Register service worker for PWA
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('https://food.arunil.in/public/sw.js')
            .then(registration => console.log('SW registered'))
            .catch(error => console.log('SW registration failed'));
    }
    </script>
</body>
</html>
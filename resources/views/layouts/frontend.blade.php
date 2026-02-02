<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Desi Delights - Authentic Indian Food Delivery')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'saffron': '#FF9933',
                        'curry': '#FF6B35',
                        'turmeric': '#FDB462'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-orange-50">
    <!-- Header -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-xl md:text-2xl font-bold text-curry">🍛 Desi Delights</a>
                
                <!-- Mobile menu button -->
                <button id="mobile-menu-btn" class="md:hidden text-gray-700 hover:text-curry">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                
                <!-- Desktop navigation -->
                <nav class="hidden md:flex space-x-6">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-curry">Home</a>
                    <a href="{{ route('menu') }}" class="text-gray-700 hover:text-curry">Menu</a>
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
                    @endauth
                </div>
            </div>
            
            <!-- Mobile navigation -->
            <nav id="mobile-menu" class="md:hidden mt-4 pb-4 border-t border-gray-200 pt-4 hidden">
                <div class="flex flex-col space-y-3">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-curry">Home</a>
                    <a href="{{ route('menu') }}" class="text-gray-700 hover:text-curry">Menu</a>
                    <a href="{{ route('cart.view') }}" class="text-gray-700 hover:text-curry flex items-center">
                        Cart
                        <span id="cartCountMobile" class="ml-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center hidden">0</span>
                    </a>
                    <a href="#testimonials" class="text-gray-700 hover:text-curry">Reviews</a>
                    <a href="#contact" class="text-gray-700 hover:text-curry">Contact</a>
                    
                    @auth
                        <div class="border-t border-gray-200 pt-3 mt-3">
                            <p class="text-gray-600 text-sm mb-2">Hi, {{ Auth::user()->name }}</p>
                            @if(Auth::user()->hasRole('user'))
                                <a href="{{ route('user.dashboard') }}" class="block text-gray-700 hover:text-curry mb-2">My Account</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-gray-700 hover:text-curry">Logout</button>
                            </form>
                        </div>
                    @else
                        <div class="border-t border-gray-200 pt-3 mt-3 space-y-2">
                            <a href="{{ route('login') }}" class="block text-gray-700 hover:text-curry">Login</a>
                            <a href="{{ route('register') }}" class="block bg-curry text-white px-4 py-2 rounded hover:bg-orange-600 text-center">Register</a>
                        </div>
                    @endauth
                </div>
            </nav>
        </div>
    </header>

    @yield('content')

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
                    <p class="text-gray-400">📞 +91 98765 43210</p>
                    <p class="text-gray-400">📧 orders@desidelights.com</p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Delivery Hours</h4>
                    <p class="text-gray-400">Mon-Sun: 11:00 AM - 11:00 PM</p>
                    <p class="text-gray-400">Free delivery on orders above ₹299</p>
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
        const cartCount = document.getElementById('cartCount');
        const cartCountMobile = document.getElementById('cartCountMobile');
        
        if (count > 0) {
            if (cartCount) {
                cartCount.textContent = count;
                cartCount.classList.remove('hidden');
            }
            if (cartCountMobile) {
                cartCountMobile.textContent = count;
                cartCountMobile.classList.remove('hidden');
            }
        } else {
            if (cartCount) cartCount.classList.add('hidden');
            if (cartCountMobile) cartCountMobile.classList.add('hidden');
        }
    }
    
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
    
    // Mobile menu toggle
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }
    });
    
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
</body>
</html>
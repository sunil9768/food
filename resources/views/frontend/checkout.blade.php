<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Desi Delights</title>
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
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-bold text-curry">🍛 Desi Delights</a>
            <nav class="hidden md:flex space-x-6">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-curry">Home</a>
                <a href="{{ route('menu') }}" class="text-gray-700 hover:text-curry">Menu</a>
                <a href="{{ route('cart.view') }}" class="text-gray-700 hover:text-curry">Cart</a>
            </nav>
        </div>
    </header>

    <!-- Checkout Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold text-center text-gray-800 mb-12">Checkout</h1>
            
            <div class="max-w-6xl mx-auto grid lg:grid-cols-2 gap-8">
                <!-- Order Summary -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-2xl font-bold mb-6">Order Summary</h2>
                    
                    @php $total = 0; @endphp
                    @foreach($cartItems as $item)
                        @php 
                            $menuItem = \App\Models\MenuItem::find($item['id']);
                            $itemTotal = $menuItem ? $menuItem->price * $item['quantity'] : 0;
                            $total += $itemTotal;
                        @endphp
                        @if($menuItem)
                        <div class="flex justify-between items-center py-3 border-b">
                            <div>
                                <h3 class="font-semibold">{{ $menuItem->name }}</h3>
                                <p class="text-gray-600">₹{{ number_format($menuItem->price) }} x {{ $item['quantity'] }}</p>
                            </div>
                            <div class="font-bold">₹{{ number_format($itemTotal) }}</div>
                        </div>
                        @endif
                    @endforeach
                    
                    <div class="pt-4">
                        <div class="flex justify-between items-center text-xl font-bold">
                            <span>Total Amount:</span>
                            <span>₹{{ number_format($total) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Customer Details Form -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    @if($isLoggedIn)
                        <h2 class="text-2xl font-bold mb-6">Delivery Details</h2>
                        <p class="text-gray-600 mb-6">Hi {{ Auth::user()->name }}! Just confirm your delivery details.</p>
                    @else
                        <h2 class="text-2xl font-bold mb-6">Your Details</h2>
                        <p class="text-gray-600 mb-6">We'll create an account for you and send login details to your email.</p>
                    @endif
                    
                    <form action="{{ route('place.order') }}" method="POST">
                        @csrf
                        
                        @foreach($cartItems as $item)
                            <input type="hidden" name="cart[]" value="{{ json_encode($item) }}">
                        @endforeach
                        
                        @if(!$isLoggedIn)
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Full Name *</label>
                            <input type="text" name="customer_name" value="{{ old('customer_name') }}" 
                                   class="w-full px-3 py-2 border rounded focus:outline-none focus:border-curry" required>
                            @error('customer_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Email Address *</label>
                            <input type="email" name="customer_email" value="{{ old('customer_email') }}" 
                                   class="w-full px-3 py-2 border rounded focus:outline-none focus:border-curry" required>
                            <p class="text-xs text-gray-500 mt-1">We'll send your account login details here</p>
                            @error('customer_email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        @else
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                            <input type="text" value="{{ Auth::user()->name }}" 
                                   class="w-full px-3 py-2 border rounded bg-gray-100" readonly>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                            <input type="email" value="{{ Auth::user()->email }}" 
                                   class="w-full px-3 py-2 border rounded bg-gray-100" readonly>
                        </div>
                        @endif

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Phone Number *</label>
                            <input type="tel" name="customer_phone" value="{{ old('customer_phone') }}" 
                                   class="w-full px-3 py-2 border rounded focus:outline-none focus:border-curry" required>
                            @error('customer_phone')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Delivery Address *</label>
                            <textarea name="customer_address" rows="3" 
                                      class="w-full px-3 py-2 border rounded focus:outline-none focus:border-curry" required>{{ old('customer_address') }}</textarea>
                            @error('customer_address')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Payment Method *</label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" name="payment_method" value="cod" checked class="mr-2">
                                    <span>Cash on Delivery (COD)</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="payment_method" value="online" class="mr-2">
                                    <span>Online Payment</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="payment_method" value="upi" class="mr-2">
                                    <span>UPI Payment</span>
                                </label>
                            </div>
                            @error('payment_method')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Special Instructions (Optional)</label>
                            <textarea name="notes" rows="2" 
                                      class="w-full px-3 py-2 border rounded focus:outline-none focus:border-curry" 
                                      placeholder="Any special requests or notes...">{{ old('notes') }}</textarea>
                        </div>

                        @if(!$isLoggedIn)
                        <div class="bg-yellow-50 border border-yellow-200 rounded p-4 mb-6">
                            <p class="text-sm text-yellow-800">
                                <strong>Note:</strong> An account will be created for you automatically. 
                                Login details will be sent to your email address.
                            </p>
                        </div>

                        <div class="flex space-x-4">
                            <button type="submit" class="flex-1 bg-curry text-white py-3 rounded-full hover:bg-orange-600 transition font-semibold">
                                Place Order & Create Account
                            </button>
                            <a href="{{ route('cart.view') }}" class="flex-1 bg-gray-300 text-gray-700 py-3 rounded-full hover:bg-gray-400 transition text-center font-semibold">
                                Back to Cart
                            </a>
                        </div>
                        @else
                        <div class="flex space-x-4">
                            <button type="submit" class="flex-1 bg-curry text-white py-3 rounded-full hover:bg-orange-600 transition font-semibold">
                                Place Order
                            </button>
                            <a href="{{ route('cart.view') }}" class="flex-1 bg-gray-300 text-gray-700 py-3 rounded-full hover:bg-gray-400 transition text-center font-semibold">
                                Back to Cart
                            </a>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Vendor Registration - {{ config('app.name', 'Desi Delights') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @if($recaptchaEnabled && $recaptchaSiteKey)
        <script src="https://www.google.com/recaptcha/api.js?render={{ $recaptchaSiteKey }}"></script>
    @endif
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-orange-50 to-red-100 min-h-screen">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-orange-600 mb-2">🍛 Desi Delights</h1>
                <h2 class="text-2xl font-semibold text-gray-900 mb-2">Join as Vendor!</h2>
                <p class="text-gray-600">Start selling your delicious food today</p>
            </div>
            
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <form method="POST" action="{{ route('vendor.register') }}" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-200 @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="restaurant_name" class="block text-sm font-medium text-gray-700 mb-2">Restaurant Name</label>
                        <input id="restaurant_name" type="text" name="restaurant_name" value="{{ old('restaurant_name') }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-200 @error('restaurant_name') border-red-500 @enderror">
                        @error('restaurant_name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-200 @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-200 @error('password') border-red-500 @enderror">
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-200">
                    </div>
                    
                    @error('recaptcha')
                        <p class="mb-4 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    
                    <button type="submit" id="vendorRegisterBtn" class="w-full bg-gradient-to-r from-orange-500 to-red-500 text-white py-3 px-4 rounded-lg font-medium hover:from-orange-600 hover:to-red-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transform transition duration-200 hover:scale-105">
                        Register as Vendor
                    </button>
                </form>
                
                <div class="mt-6 text-center space-y-2">
                    <p class="text-gray-600">Already have an account? 
                        <a href="{{ route('login') }}" class="text-orange-600 hover:text-orange-500 font-medium">Sign in here</a>
                    </p>
                    <p class="text-gray-600">Want to register as customer? 
                        <a href="{{ route('register') }}" class="text-orange-600 hover:text-orange-500 font-medium">Customer Registration</a>
                    </p>
                </div>
            </div>
            
            <div class="text-center">
                <a href="{{ url('/') }}" class="text-gray-500 hover:text-gray-700 text-sm font-medium">← Back to Home</a>
            </div>
        </div>
    </div>
    
    @if($recaptchaEnabled && $recaptchaSiteKey)
    <script>
        grecaptcha.ready(function() {
            document.getElementById('vendorRegisterBtn').addEventListener('click', function(e) {
                e.preventDefault();
                grecaptcha.execute('{{ $recaptchaSiteKey }}', {action: 'vendor_register'}).then(function(token) {
                    const form = document.querySelector('form');
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'g-recaptcha-response';
                    input.value = token;
                    form.appendChild(input);
                    form.submit();
                });
            });
        });
    </script>
    @endif
</body>
</html>
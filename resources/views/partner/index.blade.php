@extends('layouts.frontend')

@section('content')
    <!-- Partner Hero Section -->
    <section class="bg-gradient-to-r from-green-600 to-blue-600 text-white py-20">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-5xl font-bold mb-6">🍴 Partner with Desi Delights</h1>
            <p class="text-xl mb-8">Join thousands of restaurants growing their business with us</p>
            <a href="{{ route('vendor.register') }}" class="bg-white text-green-600 px-10 py-4 rounded-full text-xl font-bold hover:bg-gray-100 transition shadow-lg">
                Start Your Journey Today
            </a>
        </div>
    </section>

    <!-- Get Started Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-gray-800 mb-4">Get Started: It only takes 10 minutes</h2>
                    <p class="text-xl text-gray-600">Please keep these documents and details ready for a smooth sign-up</p>
                </div>
                
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Required Documents -->
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-100 rounded-2xl p-8 shadow-lg border border-blue-200">
                        <div class="text-center mb-6">
                            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 w-16 h-16 rounded-full flex items-center justify-center mb-4 mx-auto">
                                <span class="text-3xl text-white">📄</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800">Required Documents</h3>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center p-3 bg-white rounded-lg shadow-sm">
                                <span class="text-blue-500 text-lg mr-3">•</span>
                                <span class="text-gray-700 font-medium">PAN card</span>
                            </div>
                            <div class="flex items-center p-3 bg-white rounded-lg shadow-sm">
                                <span class="text-blue-500 text-lg mr-3">•</span>
                                <div>
                                    <span class="text-gray-700 font-medium">GST number</span>
                                    <span class="text-gray-500 text-sm block">if applicable</span>
                                </div>
                            </div>
                            <div class="flex items-center p-3 bg-white rounded-lg shadow-sm">
                                <span class="text-blue-500 text-lg mr-3">•</span>
                                <div>
                                    <span class="text-gray-700 font-medium">FSSAI license</span>
                                    <a href="#" class="text-blue-600 text-sm block hover:underline">Don't have a FSSAI license?</a>
                                </div>
                            </div>
                            <div class="flex items-center p-3 bg-white rounded-lg shadow-sm">
                                <span class="text-blue-500 text-lg mr-3">•</span>
                                <span class="text-gray-700 font-medium">Bank account details</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Images Required -->
                    <div class="bg-gradient-to-br from-green-50 to-emerald-100 rounded-2xl p-8 shadow-lg border border-green-200">
                        <div class="text-center mb-6">
                            <div class="bg-gradient-to-r from-green-500 to-emerald-600 w-16 h-16 rounded-full flex items-center justify-center mb-4 mx-auto">
                                <span class="text-3xl text-white">📷</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800">Images Required</h3>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center p-3 bg-white rounded-lg shadow-sm">
                                <span class="text-green-500 text-lg mr-3">•</span>
                                <span class="text-gray-700 font-medium">Menu images</span>
                            </div>
                            <div class="flex items-center p-3 bg-white rounded-lg shadow-sm">
                                <span class="text-green-500 text-lg mr-3">•</span>
                                <div>
                                    <span class="text-gray-700 font-medium">Profile food image</span>
                                    <a href="#" class="text-green-600 text-sm block hover:underline">What is profile food image?</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-8 p-4 bg-white rounded-lg shadow-sm">
                            <div class="text-center">
                                <div class="text-2xl mb-2">⏱️</div>
                                <h4 class="font-bold text-gray-800 mb-2">Quick Setup</h4>
                                <p class="text-gray-600 text-sm">Complete registration in just 10 minutes with all documents ready</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-12">
                    <a href="{{ route('vendor.register') }}" class="bg-gradient-to-r from-green-500 to-blue-500 text-white px-10 py-4 rounded-full text-xl font-bold hover:from-green-600 hover:to-blue-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        🚀 Start Registration Now
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Partner Benefits Section -->
    <section class="py-16 bg-gradient-to-r from-green-50 to-blue-50">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-4xl font-bold text-gray-800 mb-6">🍴 Partner with Desi Delights</h2>
                <p class="text-xl text-gray-600 mb-8">Join our platform and grow your restaurant business</p>
                
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
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-6">
                        <a href="{{ route('vendor.register') }}" class="w-full sm:w-auto bg-gradient-to-r from-green-500 to-blue-500 text-white px-6 sm:px-10 py-3 sm:py-4 rounded-full hover:from-green-600 hover:to-blue-600 transition-all duration-300 text-lg sm:text-xl font-bold shadow-lg hover:shadow-xl transform hover:-translate-y-1 text-center">
                            🏪 Register Your Restaurant FREE
                        </a>
                        <a href="#contact" class="w-full sm:w-auto border-2 border-gray-400 text-gray-700 px-6 sm:px-8 py-3 sm:py-4 rounded-full hover:border-gray-600 hover:bg-gray-50 transition-all duration-300 text-base sm:text-lg font-semibold text-center">
                            📞 Learn More
                        </a>
                    </div>
                    <div class="text-center">
                        <div class="flex flex-col sm:flex-row justify-center items-center gap-2 sm:gap-4 text-xs sm:text-sm text-gray-600">
                            <span class="bg-white px-3 sm:px-4 py-2 rounded-full shadow text-center">✨ Join 500+ restaurants</span>
                            <span class="bg-white px-3 sm:px-4 py-2 rounded-full shadow text-center">⚡ Quick Setup</span>
                            <span class="bg-white px-3 sm:px-4 py-2 rounded-full shadow text-center">🎯 Instant Results</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
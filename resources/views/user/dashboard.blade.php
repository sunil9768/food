@extends('user.layout')

@section('title', 'My Dashboard')

@section('user-content')
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Welcome back, {{ Auth::user()->name }}!</h1>
    <p class="text-gray-600">Manage your orders and account from here.</p>
</div>

<!-- Current Order -->
@if($currentOrder)
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <h2 class="text-xl font-semibold mb-4">Current Order</h2>
    <div class="border-l-4 border-curry pl-4">
        <div class="flex justify-between items-start">
            <div>
                <h3 class="font-semibold">Order #{{ $currentOrder->id }}</h3>
                <p class="text-gray-600">{{ count($currentOrder->items) }} items • ₹{{ number_format($currentOrder->total_amount) }}</p>
                <p class="text-sm text-gray-500">{{ $currentOrder->created_at->format('M d, Y h:i A') }}</p>
            </div>
            <div>
                <span class="px-3 py-1 text-sm font-semibold rounded-full 
                    @if($currentOrder->status == 'delivered') bg-green-100 text-green-800
                    @elseif($currentOrder->status == 'preparing') bg-yellow-100 text-yellow-800
                    @elseif($currentOrder->status == 'out_for_delivery') bg-blue-100 text-blue-800
                    @else bg-gray-100 text-gray-800 @endif">
                    {{ ucfirst(str_replace('_', ' ', $currentOrder->status)) }}
                </span>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('user.order.details', $currentOrder->id) }}" class="text-curry hover:text-orange-600 font-semibold">
                View Details →
            </a>
        </div>
    </div>
</div>
@endif

<!-- Quick Actions -->
<div class="grid md:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6 text-center">
        <div class="text-3xl mb-3">🍽️</div>
        <h3 class="font-semibold mb-2">Order Food</h3>
        <p class="text-gray-600 text-sm mb-4">Browse our delicious menu</p>
        <a href="{{ route('menu') }}" class="bg-curry text-white px-4 py-2 rounded hover:bg-orange-600 transition">
            Order Now
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6 text-center">
        <div class="text-3xl mb-3">📦</div>
        <h3 class="font-semibold mb-2">Track Orders</h3>
        <p class="text-gray-600 text-sm mb-4">View all your orders</p>
        <a href="{{ route('user.orders') }}" class="bg-curry text-white px-4 py-2 rounded hover:bg-orange-600 transition">
            View Orders
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6 text-center">
        <div class="text-3xl mb-3">👤</div>
        <h3 class="font-semibold mb-2">My Profile</h3>
        <p class="text-gray-600 text-sm mb-4">Update your information</p>
        <a href="{{ route('user.profile') }}" class="bg-curry text-white px-4 py-2 rounded hover:bg-orange-600 transition">
            Edit Profile
        </a>
    </div>
</div>

<!-- Recent Orders -->
<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-xl font-semibold mb-4">Recent Orders</h2>
    
    @if($orderHistory->count() > 0)
    <div class="space-y-4">
        @foreach($orderHistory as $order)
        <div class="border-b pb-4 last:border-b-0">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="font-semibold">Order #{{ $order->id }}</h3>
                    <p class="text-gray-600">{{ count($order->items) }} items • ₹{{ number_format($order->total_amount) }}</p>
                    <p class="text-sm text-gray-500">{{ $order->created_at->format('M d, Y h:i A') }}</p>
                </div>
                <div class="text-right">
                    <span class="px-3 py-1 text-sm font-semibold rounded-full 
                        @if($order->status == 'delivered') bg-green-100 text-green-800
                        @elseif($order->status == 'preparing') bg-yellow-100 text-yellow-800
                        @elseif($order->status == 'out_for_delivery') bg-blue-100 text-blue-800
                        @else bg-gray-100 text-gray-800 @endif">
                        {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                    </span>
                    <div class="mt-2">
                        <a href="{{ route('user.order.details', $order->id) }}" class="text-curry hover:text-orange-600 text-sm">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="mt-6 text-center">
        <a href="{{ route('user.orders') }}" class="text-curry hover:text-orange-600 font-semibold">
            View All Orders →
        </a>
    </div>
    @else
    <div class="text-center py-8">
        <p class="text-gray-500 mb-4">No orders yet</p>
        <a href="{{ route('menu') }}" class="bg-curry text-white px-6 py-2 rounded hover:bg-orange-600 transition">
            Place Your First Order
        </a>
    </div>
    @endif
</div>
@endsection
@extends('user.layout')

@section('title', 'Order Details')

@section('user-content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-start mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Order #{{ $order->id }}</h1>
            <p class="text-gray-600">Placed on {{ $order->created_at->format('M d, Y h:i A') }}</p>
        </div>
        <span class="px-4 py-2 text-sm font-semibold rounded-full 
            @if($order->status == 'delivered') bg-green-100 text-green-800
            @elseif($order->status == 'preparing') bg-yellow-100 text-yellow-800
            @elseif($order->status == 'out_for_delivery') bg-blue-100 text-blue-800
            @else bg-gray-100 text-gray-800 @endif">
            {{ ucfirst(str_replace('_', ' ', $order->status)) }}
        </span>
    </div>

    <!-- Order Status Timeline -->
    <div class="mb-8">
        <h3 class="text-lg font-semibold mb-4">Order Status</h3>
        <div class="flex items-center space-x-4">
            <div class="flex items-center {{ in_array($order->status, ['pending', 'confirmed', 'preparing', 'out_for_delivery', 'delivered']) ? 'text-green-600' : 'text-gray-400' }}">
                <div class="w-4 h-4 rounded-full {{ in_array($order->status, ['pending', 'confirmed', 'preparing', 'out_for_delivery', 'delivered']) ? 'bg-green-600' : 'bg-gray-400' }}"></div>
                <span class="ml-2 text-sm">Order Placed</span>
            </div>
            <div class="flex-1 h-1 {{ in_array($order->status, ['confirmed', 'preparing', 'out_for_delivery', 'delivered']) ? 'bg-green-600' : 'bg-gray-300' }}"></div>
            
            <div class="flex items-center {{ in_array($order->status, ['confirmed', 'preparing', 'out_for_delivery', 'delivered']) ? 'text-green-600' : 'text-gray-400' }}">
                <div class="w-4 h-4 rounded-full {{ in_array($order->status, ['confirmed', 'preparing', 'out_for_delivery', 'delivered']) ? 'bg-green-600' : 'bg-gray-400' }}"></div>
                <span class="ml-2 text-sm">Confirmed</span>
            </div>
            <div class="flex-1 h-1 {{ in_array($order->status, ['preparing', 'out_for_delivery', 'delivered']) ? 'bg-green-600' : 'bg-gray-300' }}"></div>
            
            <div class="flex items-center {{ in_array($order->status, ['preparing', 'out_for_delivery', 'delivered']) ? 'text-green-600' : 'text-gray-400' }}">
                <div class="w-4 h-4 rounded-full {{ in_array($order->status, ['preparing', 'out_for_delivery', 'delivered']) ? 'bg-green-600' : 'bg-gray-400' }}"></div>
                <span class="ml-2 text-sm">Preparing</span>
            </div>
            <div class="flex-1 h-1 {{ in_array($order->status, ['out_for_delivery', 'delivered']) ? 'bg-green-600' : 'bg-gray-300' }}"></div>
            
            <div class="flex items-center {{ in_array($order->status, ['out_for_delivery', 'delivered']) ? 'text-green-600' : 'text-gray-400' }}">
                <div class="w-4 h-4 rounded-full {{ in_array($order->status, ['out_for_delivery', 'delivered']) ? 'bg-green-600' : 'bg-gray-400' }}"></div>
                <span class="ml-2 text-sm">Out for Delivery</span>
            </div>
            <div class="flex-1 h-1 {{ $order->status == 'delivered' ? 'bg-green-600' : 'bg-gray-300' }}"></div>
            
            <div class="flex items-center {{ $order->status == 'delivered' ? 'text-green-600' : 'text-gray-400' }}">
                <div class="w-4 h-4 rounded-full {{ $order->status == 'delivered' ? 'bg-green-600' : 'bg-gray-400' }}"></div>
                <span class="ml-2 text-sm">Delivered</span>
            </div>
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-8">
        <!-- Order Items -->
        <div>
            <h3 class="text-lg font-semibold mb-4">Order Items</h3>
            <div class="space-y-3">
                @foreach($order->orderItems as $item)
                <div class="flex justify-between items-center py-2 border-b">
                    <div>
                        <h4 class="font-medium">{{ $item->menuItem->name }}</h4>
                        <p class="text-sm text-gray-600">₹{{ number_format($item->price) }} x {{ $item->quantity }}</p>
                    </div>
                    <div class="font-semibold">₹{{ number_format($item->price * $item->quantity) }}</div>
                </div>
                @endforeach
                
                <div class="flex justify-between items-center pt-4 text-lg font-bold">
                    <span>Total Amount:</span>
                    <span>₹{{ number_format($order->total_amount) }}</span>
                </div>
            </div>
        </div>

        <!-- Delivery Information -->
        <div>
            <h3 class="text-lg font-semibold mb-4">Delivery Information</h3>
            <div class="space-y-3">
                <div>
                    <p class="text-gray-600">Customer Name</p>
                    <p class="font-medium">{{ $order->customer_name }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Phone Number</p>
                    <p class="font-medium">{{ $order->customer_phone }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Delivery Address</p>
                    <p class="font-medium">{{ $order->customer_address }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Payment Method</p>
                    <p class="font-medium">{{ ucfirst($order->payment_method) }}</p>
                </div>
                @if($order->notes)
                <div>
                    <p class="text-gray-600">Special Instructions</p>
                    <p class="font-medium">{{ $order->notes }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="mt-8 pt-6 border-t">
        <a href="{{ route('user.orders') }}" class="text-curry hover:text-orange-600 font-semibold mr-6">
            ← Back to Orders
        </a>
        <a href="{{ route('user.order.invoice', $order->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Download Invoice
        </a>
    </div>
</div>
@endsection
@extends('user.layout')

@section('title', 'My Orders')

@section('user-content')
<div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">My Orders</h1>
    
    @if($orders->count() > 0)
    <div class="space-y-6">
        @foreach($orders as $order)
        <div class="border rounded-lg p-4">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="text-lg font-semibold">Order #{{ $order->id }}</h3>
                    <p class="text-gray-600">{{ $order->created_at->format('M d, Y h:i A') }}</p>
                </div>
                <span class="px-3 py-1 text-sm font-semibold rounded-full 
                    @if($order->status == 'delivered') bg-green-100 text-green-800
                    @elseif($order->status == 'preparing') bg-yellow-100 text-yellow-800
                    @elseif($order->status == 'out_for_delivery') bg-blue-100 text-blue-800
                    @else bg-gray-100 text-gray-800 @endif">
                    {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                </span>
            </div>
            
            <div class="grid md:grid-cols-2 gap-4 mb-4">
                <div>
                    <h4 class="font-semibold mb-2">Items Ordered:</h4>
                    <ul class="text-sm text-gray-600">
                        @foreach($order->orderItems as $item)
                        <li>{{ $item->menuItem->name }} x{{ $item->quantity }} - ₹{{ number_format($item->price * $item->quantity) }}</li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-2">Delivery Details:</h4>
                    <p class="text-sm text-gray-600">{{ $order->customer_address }}</p>
                    <p class="text-sm text-gray-600">Phone: {{ $order->customer_phone }}</p>
                    <p class="text-sm text-gray-600">Payment: {{ ucfirst($order->payment_method) }}</p>
                </div>
            </div>
            
                <div class="flex justify-between items-center">
                    <div class="text-lg font-bold">Total: ₹{{ number_format($order->total_amount) }}</div>
                    <div>
                        <a href="{{ route('user.order.details', $order->id) }}" class="text-curry hover:text-orange-600 font-semibold mr-4">
                            View Details →
                        </a>
                        <a href="{{ route('user.order.invoice', $order->id) }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                            Invoice →
                        </a>
                    </div>
                </div>
        </div>
        @endforeach
    </div>
    
    <div class="mt-6">
        {{ $orders->links() }}
    </div>
    @else
    <div class="text-center py-12">
        <div class="text-6xl mb-4">🍽️</div>
        <h2 class="text-xl font-semibold mb-2">No orders yet</h2>
        <p class="text-gray-600 mb-6">Start exploring our delicious menu!</p>
        <a href="{{ route('menu') }}" class="bg-curry text-white px-6 py-3 rounded-full hover:bg-orange-600 transition">
            Browse Menu
        </a>
    </div>
    @endif
</div>
@endsection
@extends('vendor.layout')

@section('title', 'Order Details')

@section('content')
<div class="p-6">
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

    <div class="grid md:grid-cols-2 gap-8">
        <!-- Your Items -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4">Your Items in this Order</h3>
            <div class="space-y-3">
                @php $vendorTotal = 0; @endphp
                @foreach($order->orderItems as $item)
                @php $itemTotal = $item->price * $item->quantity; $vendorTotal += $itemTotal; @endphp
                <div class="flex justify-between items-center py-2 border-b">
                    <div>
                        <h4 class="font-medium">{{ $item->menuItem->name }}</h4>
                        <p class="text-sm text-gray-600">₹{{ number_format($item->price) }} x {{ $item->quantity }}</p>
                    </div>
                    <div class="font-semibold">₹{{ number_format($itemTotal) }}</div>
                </div>
                @endforeach
                
                <div class="flex justify-between items-center pt-4 text-lg font-bold bg-yellow-50 p-3 rounded">
                    <span>Your Earnings:</span>
                    <span>₹{{ number_format($vendorTotal) }}</span>
                </div>
            </div>
        </div>

        <!-- Customer Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4">Customer Information</h3>
            <div class="space-y-3">
                <div>
                    <p class="text-gray-600">Customer Name</p>
                    <p class="font-medium">{{ $order->customer_name }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Email</p>
                    <p class="font-medium">{{ $order->customer_email }}</p>
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

    <div class="mt-8 pt-6 border-t flex justify-between">
        <a href="{{ route('vendor.orders') }}" class="text-orange-600 hover:text-orange-800 font-semibold">
            ← Back to Orders
        </a>
        <a href="{{ route('vendor.order.invoice', $order->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            View Invoice
        </a>
    </div>
</div>
@endsection
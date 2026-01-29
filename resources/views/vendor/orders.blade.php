@extends('vendor.layout')

@section('title', 'My Orders')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">My Orders</h1>
        <div class="flex space-x-2">
            <select class="border rounded px-3 py-2">
                <option>All Status</option>
                <option>Pending</option>
                <option>Preparing</option>
                <option>Out for Delivery</option>
                <option>Delivered</option>
            </select>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="p-4">
            @if($orders->count() > 0)
                <table id="ordersTable" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">My Items</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">My Total</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($orders as $order)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $order->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div>
                                    <div class="font-medium">{{ $order->customer_name }}</div>
                                    <div class="text-gray-400">{{ $order->customer_email }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                @foreach($order->orderItems as $item)
                                    <div class="mb-1 flex justify-between">
                                        <span>{{ $item->menuItem->name }}</span>
                                        <span class="text-gray-400">{{ $item->quantity }}x ₹{{ $item->price }}</span>
                                    </div>
                                @endforeach
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">
                                ₹{{ number_format($order->orderItems->sum(function($item) { return $item->price * $item->quantity; }), 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded border
                                    @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status == 'confirmed') bg-blue-100 text-blue-800
                                    @elseif($order->status == 'preparing') bg-orange-100 text-orange-800
                                    @elseif($order->status == 'ready') bg-purple-100 text-purple-800
                                    @elseif($order->status == 'delivered') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('vendor.order.details', $order->id) }}" class="text-orange-600 hover:text-orange-800 mr-3">View</a>
                                <a href="{{ route('vendor.order.invoice', $order->id) }}" class="text-blue-600 hover:text-blue-800">Invoice</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center py-8">
                    <p class="text-gray-500">No orders yet for your items.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#ordersTable').DataTable({
        "pageLength": 10,
        "responsive": true,
        "order": [[ 0, "desc" ]],
        "columnDefs": [
            { "orderable": false, "targets": [5] }
        ]
    });
});

function viewOrder(orderId) {
    // Add modal or redirect to view order details
    console.log('View order', orderId);
}
</script>
@endsection
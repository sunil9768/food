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
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @foreach($order->vendor_items as $item)
                                    <div class="mb-1">{{ $item['name'] }} ({{ $item['quantity'] }}x)</div>
                                @endforeach
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select class="px-2 py-1 text-xs font-semibold rounded border" onchange="updateOrderStatus({{ $order->id }}, this.value)">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="preparing" {{ $order->status == 'preparing' ? 'selected' : '' }}>Preparing</option>
                                    <option value="ready" {{ $order->status == 'ready' ? 'selected' : '' }}>Ready</option>
                                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button class="text-orange-600 hover:text-orange-800" onclick="viewOrder({{ $order->id }})">View</button>
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

function updateOrderStatus(orderId, status) {
    fetch(`/vendor/orders/${orderId}/status`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ status: status })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Updated!',
                text: data.message,
                timer: 1500,
                showConfirmButton: false
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Failed to update order status'
        });
    });
}
</script>
@endsection
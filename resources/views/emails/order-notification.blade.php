<!DOCTYPE html>
<html>
<head>
    <title>New Order Notification</title>
</head>
<body>
    <h2>New Order Received - Order #{{ $order->id }}</h2>
    
    <h3>Customer Details:</h3>
    <p><strong>Name:</strong> {{ $order->customer_name }}</p>
    <p><strong>Email:</strong> {{ $order->customer_email }}</p>
    <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
    <p><strong>Address:</strong> {{ $order->customer_address }}</p>
    
    <h3>Order Details:</h3>
    <p><strong>Total Amount:</strong> ₹{{ $order->total_amount }}</p>
    <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
    
    <h3>Items:</h3>
    <ul>
        @foreach($order->orderItems as $item)
            <li>{{ $item->menuItem->name }} - Qty: {{ $item->quantity }} - ₹{{ $item->price }}</li>
        @endforeach
    </ul>
    
    @if($order->notes)
        <p><strong>Notes:</strong> {{ $order->notes }}</p>
    @endif
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Order Status Update</title>
</head>
<body>
    <h2>Order Status Update - Order #{{ $order->id }}</h2>
    
    <p>Dear {{ $order->customer_name }},</p>
    
    <p>Your order status has been updated to: <strong>{{ ucfirst($order->status) }}</strong></p>
    
    <h3>Order Details:</h3>
    <p><strong>Order ID:</strong> #{{ $order->id }}</p>
    <p><strong>Total Amount:</strong> ₹{{ $order->total_amount }}</p>
    <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
    
    <h3>Items:</h3>
    <ul>
        @foreach($order->orderItems as $item)
            <li>{{ $item->menuItem->name }} - Qty: {{ $item->quantity }} - ₹{{ $item->price }}</li>
        @endforeach
    </ul>
    
    <p>Thank you for choosing Desi Delights!</p>
</body>
</html>
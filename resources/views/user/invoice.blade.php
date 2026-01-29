<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { text-align: center; margin-bottom: 30px; }
        .invoice-details { margin-bottom: 30px; }
        .customer-details { margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f8f9fa; }
        .total { font-weight: bold; font-size: 18px; }
        .print-btn { margin: 20px 0; }
        @media print { .print-btn { display: none; } }
    </style>
</head>
<body>
    <div class="print-btn">
        <button onclick="window.print()" style="background: #f97316; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Print Invoice</button>
        <a href="{{ route('user.orders') }}" style="margin-left: 10px; color: #f97316; text-decoration: none;">← Back to Orders</a>
    </div>

    <div class="header">
        <h1>🍛 Desi Delights</h1>
        <p>Multi-Vendor Food Delivery</p>
        <h2>INVOICE</h2>
    </div>

    <div class="invoice-details">
        <strong>Invoice #:</strong> {{ $order->id }}<br>
        <strong>Date:</strong> {{ $order->created_at->format('M d, Y') }}<br>
        <strong>Status:</strong> {{ ucfirst($order->status) }}
    </div>

    <div class="customer-details">
        <h3>Bill To:</h3>
        <strong>{{ $order->customer_name }}</strong><br>
        {{ $order->customer_email }}<br>
        {{ $order->customer_phone }}<br>
        {{ $order->customer_address }}
    </div>

    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderItems as $item)
            <tr>
                <td>{{ $item->menuItem->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>₹{{ number_format($item->price, 2) }}</td>
                <td>₹{{ number_format($item->price * $item->quantity, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total">
                <td colspan="3">Total Amount:</td>
                <td>₹{{ number_format($order->total_amount, 2) }}</td>
            </tr>
        </tfoot>
    </table>

    <div style="margin-top: 30px;">
        <strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}<br>
        @if($order->notes)
        <strong>Notes:</strong> {{ $order->notes }}
        @endif
    </div>

    <div style="text-align: center; margin-top: 50px; color: #666;">
        <p>Thank you for choosing Desi Delights!</p>
    </div>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Vendor Invoice #{{ $order->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { text-align: center; margin-bottom: 30px; }
        .invoice-details { margin-bottom: 30px; }
        .vendor-details { margin-bottom: 30px; background: #f8f9fa; padding: 15px; border-radius: 5px; }
        .customer-details { margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f8f9fa; }
        .total { font-weight: bold; font-size: 18px; background-color: #fff3cd; }
        .print-btn { margin: 20px 0; }
        @media print { .print-btn { display: none; } }
    </style>
</head>
<body>
    <div class="print-btn">
        <button onclick="window.print()" style="background: #f97316; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Print Invoice</button>
        <a href="{{ route('vendor.orders') }}" style="margin-left: 10px; color: #f97316; text-decoration: none;">← Back to Orders</a>
    </div>

    <div class="header">
        <h1>🍛 {{ Auth::user()->restaurant_name ?? Auth::user()->name }}</h1>
        <p>Vendor Invoice</p>
        <h2>ORDER #{{ $order->id }}</h2>
    </div>

    <div class="vendor-details">
        <h3>Vendor Details:</h3>
        <strong>{{ Auth::user()->restaurant_name ?? Auth::user()->name }}</strong><br>
        {{ Auth::user()->email }}<br>
        Vendor ID: {{ Auth::user()->id }}
    </div>

    <div class="invoice-details">
        <strong>Order Date:</strong> {{ $order->created_at->format('M d, Y h:i A') }}<br>
        <strong>Order Status:</strong> {{ ucfirst($order->status) }}<br>
        <strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}
    </div>

    <div class="customer-details">
        <h3>Customer Details:</h3>
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
            @php $vendorTotal = 0; @endphp
            @foreach($order->orderItems as $item)
            @php $itemTotal = $item->price * $item->quantity; $vendorTotal += $itemTotal; @endphp
            <tr>
                <td>{{ $item->menuItem->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>₹{{ number_format($item->price, 2) }}</td>
                <td>₹{{ number_format($itemTotal, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total">
                <td colspan="3"><strong>Your Earnings from this Order:</strong></td>
                <td><strong>₹{{ number_format($vendorTotal, 2) }}</strong></td>
            </tr>
        </tfoot>
    </table>

    @if($order->notes)
    <div style="margin-top: 20px;">
        <strong>Customer Notes:</strong> {{ $order->notes }}
    </div>
    @endif

    <div style="text-align: center; margin-top: 50px; color: #666; border-top: 1px solid #ddd; padding-top: 20px;">
        <p><strong>Note:</strong> This invoice shows only your items from Order #{{ $order->id }}</p>
        <p>Generated on {{ now()->format('M d, Y h:i A') }}</p>
    </div>
</body>
</html>
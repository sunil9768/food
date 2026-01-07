<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $orders = [
            [
                'customer_name' => 'Priya Sharma',
                'customer_email' => 'priya@example.com',
                'customer_phone' => '9876543210',
                'customer_address' => '123 Main Street, Delhi',
                'total_amount' => 149.00,
                'status' => 'delivered',
                'payment_status' => 'paid',
                'payment_method' => 'online',
                'items' => [
                    ['name' => 'Aalu Sabji', 'price' => 89, 'quantity' => 1],
                    ['name' => 'Roti', 'price' => 30, 'quantity' => 2]
                ],
                'notes' => 'Extra spicy please'
            ],
            [
                'customer_name' => 'Rahul Kumar',
                'customer_email' => 'rahul@example.com',
                'customer_phone' => '9876543211',
                'customer_address' => '456 Park Avenue, Mumbai',
                'total_amount' => 129.00,
                'status' => 'preparing',
                'payment_status' => 'paid',
                'payment_method' => 'upi',
                'items' => [
                    ['name' => 'Dal Tadka', 'price' => 99, 'quantity' => 1],
                    ['name' => 'Rice', 'price' => 30, 'quantity' => 1]
                ]
            ],
            [
                'customer_name' => 'Anita Patel',
                'customer_email' => 'anita@example.com',
                'customer_phone' => '9876543212',
                'customer_address' => '789 Garden Road, Pune',
                'total_amount' => 189.00,
                'status' => 'out_for_delivery',
                'payment_status' => 'paid',
                'payment_method' => 'cod',
                'items' => [
                    ['name' => 'Paneer Butter Masala', 'price' => 159, 'quantity' => 1],
                    ['name' => 'Naan', 'price' => 30, 'quantity' => 1]
                ]
            ],
            [
                'customer_name' => 'Vikash Singh',
                'customer_email' => 'vikash@example.com',
                'customer_phone' => '9876543213',
                'customer_address' => '321 Hill View, Bangalore',
                'total_amount' => 99.00,
                'status' => 'pending',
                'payment_status' => 'pending',
                'payment_method' => 'cod',
                'items' => [
                    ['name' => 'Chole Bhature', 'price' => 99, 'quantity' => 1]
                ]
            ]
        ];

        foreach ($orders as $orderData) {
            Order::create($orderData);
        }
    }
}
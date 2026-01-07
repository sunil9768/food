@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="p-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <span class="text-2xl">📦</span>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Orders</p>
                    <p class="text-2xl font-semibold text-gray-900">1,234</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <span class="text-2xl">💰</span>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Revenue</p>
                    <p class="text-2xl font-semibold text-gray-900">₹45,678</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <span class="text-2xl">👥</span>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Customers</p>
                    <p class="text-2xl font-semibold text-gray-900">567</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <span class="text-2xl">🍽️</span>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Menu Items</p>
                    <p class="text-2xl font-semibold text-gray-900">89</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-semibold text-gray-800">Recent Orders</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Items</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#1001</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Priya Sharma</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Aalu Sabji, Roti</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">₹149</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                Delivered
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button class="text-primary hover:text-orange-600">View</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#1002</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rahul Kumar</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dal Tadka</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">₹129</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Preparing
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button class="text-primary hover:text-orange-600">View</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#1003</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Anita Patel</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Paneer Butter Masala</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">₹189</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                Out for Delivery
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button class="text-primary hover:text-orange-600">View</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
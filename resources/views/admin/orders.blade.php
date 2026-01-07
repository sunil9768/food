@extends('admin.layout')

@section('title', 'Orders Management')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Orders Management</h1>
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
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Items</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#1001</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div>
                                <div class="font-medium">Priya Sharma</div>
                                <div class="text-gray-400">priya@example.com</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Aalu Sabji, Roti (2x)</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">₹149</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <select class="px-2 py-1 text-xs font-semibold rounded border">
                                <option>Pending</option>
                                <option>Preparing</option>
                                <option>Out for Delivery</option>
                                <option selected>Delivered</option>
                            </select>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Jan 6, 2024</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button class="text-primary hover:text-orange-600 mr-3">View</button>
                            <button class="text-red-600 hover:text-red-800">Cancel</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#1002</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div>
                                <div class="font-medium">Rahul Kumar</div>
                                <div class="text-gray-400">rahul@example.com</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dal Tadka, Rice</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">₹129</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <select class="px-2 py-1 text-xs font-semibold rounded border">
                                <option>Pending</option>
                                <option selected>Preparing</option>
                                <option>Out for Delivery</option>
                                <option>Delivered</option>
                            </select>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Jan 6, 2024</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button class="text-primary hover:text-orange-600 mr-3">View</button>
                            <button class="text-red-600 hover:text-red-800">Cancel</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#1003</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div>
                                <div class="font-medium">Anita Patel</div>
                                <div class="text-gray-400">anita@example.com</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Paneer Butter Masala</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">₹189</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <select class="px-2 py-1 text-xs font-semibold rounded border">
                                <option>Pending</option>
                                <option>Preparing</option>
                                <option selected>Out for Delivery</option>
                                <option>Delivered</option>
                            </select>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Jan 6, 2024</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button class="text-primary hover:text-orange-600 mr-3">View</button>
                            <button class="text-red-600 hover:text-red-800">Cancel</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
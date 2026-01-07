@extends('admin.layout')

@section('title', 'Settings')

@section('content')
<div class="p-6">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Settings</h1>

    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Restaurant Settings -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Restaurant Settings</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Restaurant Name</label>
                        <input type="text" name="restaurant_name" value="{{ $settings['restaurant_name'] ?? 'DesiDelights' }}" class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                        <input type="text" name="restaurant_phone" value="{{ $settings['restaurant_phone'] ?? '+91 98765 43210' }}" class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" name="restaurant_email" value="{{ $settings['restaurant_email'] ?? 'orders@desidelights.com' }}" class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                        <textarea name="restaurant_address" class="w-full border rounded px-3 py-2 h-20">{{ $settings['restaurant_address'] ?? '123 Food Street, Delhi, India' }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Delivery Settings -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Delivery Settings</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Opening Time</label>
                        <input type="time" name="opening_time" value="{{ $settings['opening_time'] ?? '11:00' }}" class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Closing Time</label>
                        <input type="time" name="closing_time" value="{{ $settings['closing_time'] ?? '23:00' }}" class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Delivery Fee (₹)</label>
                        <input type="number" name="delivery_fee" value="{{ $settings['delivery_fee'] ?? '30' }}" class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Free Delivery Above (₹)</label>
                        <input type="number" name="free_delivery_above" value="{{ $settings['free_delivery_above'] ?? '299' }}" class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Delivery Radius (km)</label>
                        <input type="number" name="delivery_radius" value="{{ $settings['delivery_radius'] ?? '10' }}" class="w-full border rounded px-3 py-2">
                    </div>
                </div>
            </div>

            <!-- Payment Settings -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Payment Settings</h3>
                <div class="space-y-4">
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="payment_cod" value="1" {{ ($settings['payment_cod'] ?? '1') == '1' ? 'checked' : '' }} class="mr-2">
                            <span class="text-sm text-gray-700">Cash on Delivery</span>
                        </label>
                    </div>
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="payment_online" value="1" {{ ($settings['payment_online'] ?? '1') == '1' ? 'checked' : '' }} class="mr-2">
                            <span class="text-sm text-gray-700">Online Payment</span>
                        </label>
                    </div>
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="payment_upi" value="1" {{ ($settings['payment_upi'] ?? '0') == '1' ? 'checked' : '' }} class="mr-2">
                            <span class="text-sm text-gray-700">UPI Payment</span>
                        </label>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tax Rate (%)</label>
                        <input type="number" name="tax_rate" value="{{ $settings['tax_rate'] ?? '18' }}" step="0.01" class="w-full border rounded px-3 py-2">
                    </div>
                </div>
            </div>

            <!-- Notification Settings -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Notification Settings</h3>
                <div class="space-y-4">
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="notifications_email" value="1" {{ ($settings['notifications_email'] ?? '1') == '1' ? 'checked' : '' }} class="mr-2">
                            <span class="text-sm text-gray-700">Email Notifications</span>
                        </label>
                    </div>
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="notifications_sms" value="1" {{ ($settings['notifications_sms'] ?? '1') == '1' ? 'checked' : '' }} class="mr-2">
                            <span class="text-sm text-gray-700">SMS Notifications</span>
                        </label>
                    </div>
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="notifications_push" value="1" {{ ($settings['notifications_push'] ?? '0') == '1' ? 'checked' : '' }} class="mr-2">
                            <span class="text-sm text-gray-700">Push Notifications</span>
                        </label>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Admin Email</label>
                        <input type="email" name="admin_email" value="{{ $settings['admin_email'] ?? 'admin@desidelights.com' }}" class="w-full border rounded px-3 py-2">
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 flex justify-end">
            <button type="submit" class="bg-primary text-white px-6 py-3 rounded hover:bg-orange-600">
                Save All Settings
            </button>
        </div>
    </form>
</div>
@endsection
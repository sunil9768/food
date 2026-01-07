@extends('user.layout')

@section('title', 'My Profile')

@section('user-content')
<div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">My Profile</h1>
    
    <form action="{{ route('user.profile.update') }}" method="POST">
        @csrf
        
        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Full Name</label>
                <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" 
                       class="w-full px-3 py-2 border rounded focus:outline-none focus:border-curry" required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
                <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" 
                       class="w-full px-3 py-2 border rounded focus:outline-none focus:border-curry" required>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-6 border-t pt-6">
            <h3 class="text-lg font-semibold mb-4">Change Password</h3>
            <p class="text-gray-600 text-sm mb-4">Leave blank if you don't want to change your password</p>
            
            <div class="grid md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Current Password</label>
                    <input type="password" name="current_password" 
                           class="w-full px-3 py-2 border rounded focus:outline-none focus:border-curry">
                    @error('current_password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">New Password</label>
                    <input type="password" name="password" 
                           class="w-full px-3 py-2 border rounded focus:outline-none focus:border-curry">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Confirm New Password</label>
                    <input type="password" name="password_confirmation" 
                           class="w-full px-3 py-2 border rounded focus:outline-none focus:border-curry">
                </div>
            </div>
        </div>

        <div class="mt-8">
            <button type="submit" class="bg-curry text-white px-6 py-3 rounded hover:bg-orange-600 transition">
                Update Profile
            </button>
        </div>
    </form>
</div>

<div class="bg-white rounded-lg shadow p-6 mt-6">
    <h2 class="text-xl font-semibold mb-4">Account Information</h2>
    <div class="grid md:grid-cols-2 gap-6">
        <div>
            <p class="text-gray-600">Member since</p>
            <p class="font-semibold">{{ Auth::user()->created_at->format('M d, Y') }}</p>
        </div>
        <div>
            <p class="text-gray-600">Total Orders</p>
            <p class="font-semibold">{{ App\Models\Order::where('customer_email', Auth::user()->email)->count() }}</p>
        </div>
    </div>
</div>
@endsection
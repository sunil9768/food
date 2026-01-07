@extends('layouts.frontend')

@section('title', 'My Dashboard - Desi Delights')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-wrap -mx-4">
        <!-- Sidebar -->
        <div class="w-full md:w-1/4 px-4 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-4">My Account</h3>
                <nav class="space-y-2">
                    <a href="{{ route('user.dashboard') }}" class="block py-2 px-3 rounded {{ request()->routeIs('user.dashboard') ? 'bg-curry text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('user.orders') }}" class="block py-2 px-3 rounded {{ request()->routeIs('user.orders*') ? 'bg-curry text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                        My Orders
                    </a>
                    <a href="{{ route('user.profile') }}" class="block py-2 px-3 rounded {{ request()->routeIs('user.profile') ? 'bg-curry text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                        Profile
                    </a>
                    <a href="{{ route('menu') }}" class="block py-2 px-3 rounded text-gray-700 hover:bg-gray-100">
                        Order Food
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="w-full md:w-3/4 px-4">
            @yield('user-content')
        </div>
    </div>
</div>
@endsection
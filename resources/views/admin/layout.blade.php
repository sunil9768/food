<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - DesiDelights Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#ec7f13',
                        'secondary': '#9a734c'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-primary">🍛 DesiDelights</h2>
                <p class="text-sm text-gray-600">Admin Panel</p>
            </div>
            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.dashboard') ? 'text-primary bg-orange-50 border-r-4 border-primary' : 'text-gray-700 hover:bg-gray-50' }}">
                    <span class="mr-3">📊</span>
                    Dashboard
                </a>
                <a href="{{ route('admin.menu') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.menu') ? 'text-primary bg-orange-50 border-r-4 border-primary' : 'text-gray-700 hover:bg-gray-50' }}">
                    <span class="mr-3">🍽️</span>
                    Menu Items
                </a>
                <a href="{{ route('admin.orders') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.orders') ? 'text-primary bg-orange-50 border-r-4 border-primary' : 'text-gray-700 hover:bg-gray-50' }}">
                    <span class="mr-3">📦</span>
                    Orders
                </a>
                <a href="{{ route('admin.users') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.users') ? 'text-primary bg-orange-50 border-r-4 border-primary' : 'text-gray-700 hover:bg-gray-50' }}">
                    <span class="mr-3">👥</span>
                    Users
                </a>
                <a href="{{ route('admin.settings') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.settings') ? 'text-primary bg-orange-50 border-r-4 border-primary' : 'text-gray-700 hover:bg-gray-50' }}">
                    <span class="mr-3">⚙️</span>
                    Settings
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-x-hidden overflow-y-auto">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b">
                <div class="flex items-center justify-between px-6 py-4">
                    <h1 class="text-2xl font-semibold text-gray-800">@yield('title', 'Dashboard')</h1>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600">Welcome, {{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="bg-primary text-white px-4 py-2 rounded hover:bg-orange-600">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
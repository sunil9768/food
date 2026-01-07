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
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.tailwindcss.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                <a href="{{ route('admin.categories') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.categories*') ? 'text-primary bg-orange-50 border-r-4 border-primary' : 'text-gray-700 hover:bg-gray-50' }}">
                    <span class="mr-3">📂</span>
                    Categories
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
    
    <script>
    // Common SweetAlert Delete Function
    function confirmDelete(url, title = 'Delete Item', text = 'This action cannot be undone!') {
        Swal.fire({
            title: title,
            text: text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Create form and submit
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = url;
                form.innerHTML = `
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="DELETE">
                `;
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
    
    // Success/Error Messages
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif
    
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ session('error') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif
    </script>
</body>
</html>
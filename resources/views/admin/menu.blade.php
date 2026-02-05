@extends('admin.layout')

@section('title', 'Menu Management')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Menu Management</h1>
        <button onclick="window.location.href='{{ route('admin.menu.create') }}'" class="bg-primary text-white px-4 py-2 rounded hover:bg-orange-600">
            Add New Item
        </button>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="p-4">
            <table id="menuTable" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Image</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($menuItems as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($item->image)
                                <img class="h-10 w-10 rounded-full object-cover" src="@storageAsset($item->image)" alt="{{ $item->name }}">
                            @else
                                <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-400 text-xs">No Image</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->category->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $item->description }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">₹{{ number_format($item->price, 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $item->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $item->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.menu.edit', $item->id) }}" class="text-primary hover:text-orange-600 mr-3">Edit</a>
                            <button onclick="confirmDelete('{{ route('admin.menu.delete', $item->id) }}', 'Delete Menu Item?', 'This will permanently delete this menu item.')" class="text-red-600 hover:text-red-800">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#menuTable').DataTable({
        "pageLength": 10,
        "responsive": true,
        "order": [[ 1, "asc" ]],
        "columnDefs": [
            { "orderable": false, "targets": [0, 6] }
        ]
    });
});
</script>
@endsection
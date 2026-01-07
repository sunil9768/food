@extends('admin.layout')

@section('title', 'Menu Management')

@section('content')
<div class="p-6">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Menu Management</h1>
        <button onclick="window.location.href='{{ route('admin.menu.create') }}'" class="bg-primary text-white px-4 py-2 rounded hover:bg-orange-600">
            Add New Item
        </button>
    </div>

    <!-- Category Tabs -->
    <div class="mb-6">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8">
                @foreach($categories as $index => $category)
                <button class="category-tab py-2 px-1 border-b-2 font-medium text-sm {{ $index === 0 ? 'border-primary text-primary' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}" 
                        data-category="{{ $category->id }}">
                    {{ $category->name }}
                </button>
                @endforeach
            </nav>
        </div>
    </div>

    @foreach($categories as $index => $category)
    <div class="category-content bg-white rounded-lg shadow {{ $index === 0 ? '' : 'hidden' }}" data-category="{{ $category->id }}">
        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-semibold text-gray-800">{{ $category->name }}</h3>
            <p class="text-sm text-gray-600">{{ $category->description }}</p>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Image</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($category->menuItems as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($item->image)
                                <img class="h-10 w-10 rounded-full object-cover" src="{{ asset($item->image) }}" alt="{{ $item->name }}">
                            @else
                                <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-400 text-xs">No Image</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $item->description }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">₹{{ number_format($item->price, 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $item->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $item->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button class="text-primary hover:text-orange-600 mr-3">Edit</button>
                            <button class="text-red-600 hover:text-red-800">Delete</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">No items in this category</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @endforeach
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.category-tab');
    const contents = document.querySelectorAll('.category-content');
    
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const categoryId = this.dataset.category;
            
            // Update tab styles
            tabs.forEach(t => {
                t.classList.remove('border-primary', 'text-primary');
                t.classList.add('border-transparent', 'text-gray-500');
            });
            this.classList.add('border-primary', 'text-primary');
            this.classList.remove('border-transparent', 'text-gray-500');
            
            // Show/hide content
            contents.forEach(content => {
                if (content.dataset.category === categoryId) {
                    content.classList.remove('hidden');
                } else {
                    content.classList.add('hidden');
                }
            });
        });
    });
});
</script>
@endsection
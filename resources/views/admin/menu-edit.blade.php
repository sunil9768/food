@extends('admin.layout')

@section('title', 'Edit Menu Item')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Edit Menu Item</h1>
        <a href="{{ route('admin.menu') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            Back to Menu
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.menu.update', $menuItem->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                    <input type="text" name="name" value="{{ old('name', $menuItem->name) }}" 
                           class="w-full px-3 py-2 border rounded focus:outline-none focus:border-primary" required>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Category</label>
                    <select name="category_id" class="w-full px-3 py-2 border rounded focus:outline-none focus:border-primary" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $menuItem->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Price (₹)</label>
                    <input type="number" name="price" value="{{ old('price', $menuItem->price) }}" step="0.01" min="0"
                           class="w-full px-3 py-2 border rounded focus:outline-none focus:border-primary" required>
                    @error('price')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Image</label>
                    <input type="file" name="image" accept="image/*"
                           class="w-full px-3 py-2 border rounded focus:outline-none focus:border-primary">
                    @if($menuItem->image)
                        <img src="{{ asset($menuItem->image) }}" alt="{{ $menuItem->name }}" class="mt-2 h-20 w-20 object-cover rounded">
                    @endif
                    @error('image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                <textarea name="description" rows="3" 
                          class="w-full px-3 py-2 border rounded focus:outline-none focus:border-primary">{{ old('description', $menuItem->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" {{ $menuItem->is_active ? 'checked' : '' }} class="mr-2">
                    <span class="text-gray-700 text-sm font-bold">Active</span>
                </label>
            </div>

            <div class="flex space-x-4 mt-6">
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded hover:bg-orange-600">
                    Update Menu Item
                </button>
                <a href="{{ route('admin.menu') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
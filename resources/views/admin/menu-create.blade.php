@extends('admin.layout')

@section('title', 'Add New Menu Item')

@section('content')
<div class="p-6">
    <div class="flex items-center mb-6">
        <a href="{{ route('admin.menu') }}" class="text-gray-600 hover:text-gray-800 mr-4">
            ← Back to Menu
        </a>
        <h1 class="text-2xl font-semibold text-gray-800">Add New Menu Item</h1>
    </div>

    <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
        <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Item Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" 
                           class="w-full border rounded px-3 py-2 @error('name') border-red-500 @enderror" 
                           placeholder="e.g., Chicken Biryani" required>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select name="category_id" class="w-full border rounded px-3 py-2 @error('category_id') border-red-500 @enderror" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" rows="3" 
                              class="w-full border rounded px-3 py-2 @error('description') border-red-500 @enderror" 
                              placeholder="Brief description of the dish">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Price (₹)</label>
                    <input type="number" name="price" value="{{ old('price') }}" step="0.01" min="0"
                           class="w-full border rounded px-3 py-2 @error('price') border-red-500 @enderror" 
                           placeholder="149.00" required>
                    @error('price')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Image</label>
                    <input type="file" name="image" accept="image/*"
                           class="w-full border rounded px-3 py-2 @error('image') border-red-500 @enderror">
                    @error('image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1">Optional: Upload JPG, PNG, GIF (max 2MB)</p>
                </div>

                <div>
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="mr-2">
                        <span class="text-sm text-gray-700">Active (visible to customers)</span>
                    </label>
                </div>
            </div>

            <div class="flex justify-end space-x-4 mt-8">
                <a href="{{ route('admin.menu') }}" class="px-4 py-2 border border-gray-300 rounded text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded hover:bg-orange-600">
                    Add Menu Item
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
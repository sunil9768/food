@extends('admin.layout')

@section('title', 'Add New Category')

@section('content')
<div class="p-6">
    <div class="flex items-center mb-6">
        <a href="{{ route('admin.categories') }}" class="text-gray-600 hover:text-gray-800 mr-4">
            ← Back to Categories
        </a>
        <h1 class="text-2xl font-semibold text-gray-800">Add New Category</h1>
    </div>

    <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" 
                           class="w-full border rounded px-3 py-2 @error('name') border-red-500 @enderror" 
                           placeholder="e.g., Main Course" required>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" rows="3" 
                              class="w-full border rounded px-3 py-2 @error('description') border-red-500 @enderror" 
                              placeholder="Brief description of the category">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end space-x-4 mt-8">
                <a href="{{ route('admin.categories') }}" class="px-4 py-2 border border-gray-300 rounded text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded hover:bg-orange-600">
                    Add Category
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
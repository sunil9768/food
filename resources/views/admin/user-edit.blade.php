@extends('admin.layout')

@section('title', 'Edit User')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Edit User</h1>
        <a href="{{ route('admin.users') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            Back to Users
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                       class="w-full px-3 py-2 border rounded focus:outline-none focus:border-primary" required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                       class="w-full px-3 py-2 border rounded focus:outline-none focus:border-primary" required>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Role</label>
                <select name="role" class="w-full px-3 py-2 border rounded focus:outline-none focus:border-primary" required>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
                @error('role')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded hover:bg-orange-600">
                    Update User
                </button>
                <a href="{{ route('admin.users') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
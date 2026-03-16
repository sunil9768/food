@extends('layouts.frontend')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Search Results</h1>
        <p class="text-gray-600">Found {{ $menuItems->total() }} results for "{{ $query }}"</p>
    </div>

    @if($menuItems->count() > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($menuItems as $item)
            <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition overflow-hidden">
                @if($item->image)
                    <img src="@storageAsset($item->image)" alt="{{ $item->name }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-400 text-2xl">🍽️</span>
                    </div>
                @endif
                
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-bold text-gray-800">{{ $item->name }}</h3>
                        @if($item->vendor)
                            <span class="bg-orange-200 text-orange-800 text-xs px-2 py-1 rounded-full">{{ $item->vendor->restaurant_name ?: $item->vendor->name }}</span>
                        @endif
                    </div>
                    
                    @if($item->category)
                        <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-full mb-2 inline-block">{{ $item->category->name }}</span>
                    @endif
                    
                    <p class="text-gray-600 mb-4 line-clamp-2">{{ $item->description ?: 'Delicious ' . $item->name }}</p>
                    
                    <div class="flex justify-between items-center">
                        <span class="text-2xl font-bold text-orange-600">₹{{ number_format($item->price) }}</span>
                        <a href="{{ route('item.view', $item->id) }}" class="bg-orange-500 text-white px-4 py-2 rounded-full hover:bg-orange-600 transition">
                            View Item
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="mt-8">
            {{ $menuItems->appends(['q' => $query])->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <div class="text-6xl mb-4">🔍</div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">No items found</h2>
            <p class="text-gray-600 mb-6">We couldn't find any items matching "{{ $query }}"</p>
            <a href="{{ route('home') }}" class="bg-orange-500 text-white px-6 py-3 rounded-full hover:bg-orange-600 transition">
                Browse All Items
            </a>
        </div>
    @endif
</div>
@endsection
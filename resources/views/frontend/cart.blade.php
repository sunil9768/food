@extends('layouts.frontend')

@section('title', 'Cart - Desi Delights')

@section('content')
    <!-- Cart Section -->
    <section class="py-4 md:py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-2xl md:text-4xl font-bold text-center text-gray-800 mb-6 md:mb-12">Your Cart</h1>
            
            <div id="cartContent" class="max-w-4xl mx-auto">
                <!-- Cart items will be loaded here by JavaScript -->
            </div>
            
            <div id="emptyCart" class="text-center py-12 md:py-16 hidden">
                <div class="text-6xl md:text-8xl mb-4">🛒</div>
                <h2 class="text-xl md:text-2xl font-bold text-gray-600 mb-4">Your cart is empty</h2>
                <p class="text-gray-500 mb-6">Add some delicious items to get started!</p>
                <a href="{{ route('menu') }}" class="bg-curry text-white px-6 py-3 rounded-full hover:bg-orange-600 transition">
                    Browse Menu
                </a>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
// Cart page specific functions
function loadCart() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const cartContent = document.getElementById('cartContent');
    const emptyCart = document.getElementById('emptyCart');
    
    if (cart.length === 0) {
        cartContent.classList.add('hidden');
        emptyCart.classList.remove('hidden');
        return;
    }
    
    emptyCart.classList.add('hidden');
    cartContent.classList.remove('hidden');
    
    let total = 0;
    let cartHtml = '<div class="bg-white rounded-lg shadow-lg p-4 md:p-6">';
    
    cart.forEach((item, index) => {
        const itemTotal = item.price * item.quantity;
        total += itemTotal;
        
        cartHtml += `
            <div class="flex items-center justify-between py-4 border-b last:border-b-0">
                <div class="flex items-center flex-1">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-gray-200 rounded flex items-center justify-center flex-shrink-0">
                        <span class="text-gray-400 text-lg md:text-xl">🍽️</span>
                    </div>
                    <div class="ml-3 md:ml-4 flex-1">
                        <h3 class="text-sm md:text-lg font-semibold line-clamp-1">${item.name}</h3>
                        <p class="text-gray-600 text-xs md:text-base">₹${item.price} each</p>
                    </div>
                </div>
                
                <div class="flex flex-col md:flex-row items-end md:items-center space-y-2 md:space-y-0 md:space-x-4">
                    <div class="flex items-center">
                        <button onclick="updateCartQuantity(${index}, -1)" class="bg-gray-200 px-2 py-1 rounded text-sm hover:bg-gray-300">−</button>
                        <span class="mx-3 font-semibold text-sm md:text-base min-w-[2rem] text-center">${item.quantity}</span>
                        <button onclick="updateCartQuantity(${index}, 1)" class="bg-gray-200 px-2 py-1 rounded text-sm hover:bg-gray-300">+</button>
                    </div>
                    <div class="text-sm md:text-lg font-bold min-w-[4rem] text-right">₹${itemTotal}</div>
                    <button onclick="removeCartItem(${index})" class="text-red-600 hover:text-red-800 text-xs md:text-sm">
                        <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        `;
    });
    
    cartHtml += `
        <div class="pt-4 md:pt-6">
            <div class="flex flex-col space-y-4">
                <div class="flex justify-between items-center text-lg md:text-xl font-bold">
                    <span>Total:</span>
                    <span class="text-curry">₹${total}</span>
                </div>
                <button onclick="proceedToCheckout()" class="w-full bg-curry text-white px-6 md:px-8 py-3 md:py-4 rounded-full hover:bg-orange-600 transition text-center font-semibold">
                    Proceed to Checkout →
                </button>
            </div>
        </div>
    </div>`;
    
    cartContent.innerHTML = cartHtml;
}

function updateCartQuantity(index, change) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart[index].quantity += change;
    if (cart[index].quantity <= 0) {
        cart.splice(index, 1);
    }
    localStorage.setItem('cart', JSON.stringify(cart));
    loadCart();
    updateCartCount();
}

function removeCartItem(index) {
    Swal.fire({
        title: 'Remove Item?',
        text: 'Are you sure you want to remove this item from cart?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, remove it!'
    }).then((result) => {
        if (result.isConfirmed) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            cart.splice(index, 1);
            localStorage.setItem('cart', JSON.stringify(cart));
            loadCart();
            updateCartCount();
        }
    });
}

function proceedToCheckout() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    if (cart.length === 0) {
        Swal.fire('Cart is empty!', 'Add some items to your cart first.', 'info');
        return;
    }
    
    // Get CSRF token from meta tag
    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
    
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route('checkout') }}';
    form.innerHTML = `
        <input type="hidden" name="_token" value="${token}">
        <input type="hidden" name="cart" value='${JSON.stringify(cart)}'>
    `;
    document.body.appendChild(form);
    form.submit();
}

// Load cart on page load
loadCart();
</script>
@endsection
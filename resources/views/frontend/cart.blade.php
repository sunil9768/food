@extends('layouts.frontend')

@section('title', 'Cart - Desi Delights')

@section('content')
    <!-- Cart Section -->
    <section class="py-8 md:py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-2xl md:text-4xl font-bold text-center text-gray-800 mb-8 md:mb-12">Your Cart</h1>
            
            <div id="cartContent" class="max-w-4xl mx-auto">
                <!-- Cart items will be loaded here by JavaScript -->
            </div>
            
            <div id="emptyCart" class="text-center py-12 md:py-16 hidden">
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
    let cartHtml = '<div class="bg-white rounded-lg shadow-lg p-6">';
    
    cart.forEach((item, index) => {
        const itemTotal = item.price * item.quantity;
        total += itemTotal;
        
        cartHtml += `
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between py-4 border-b space-y-3 sm:space-y-0">
                <div class="flex items-center">
                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-gray-200 rounded flex items-center justify-center flex-shrink-0">
                        <span class="text-gray-400 text-lg sm:text-xl">🍽️</span>
                    </div>
                    <div class="ml-3 sm:ml-4">
                        <h3 class="text-base sm:text-lg font-semibold">${item.name}</h3>
                        <p class="text-gray-600 text-sm sm:text-base">₹${item.price} each</p>
                    </div>
                </div>
                
                <div class="flex items-center justify-between sm:justify-end sm:space-x-4">
                    <div class="flex items-center">
                        <button onclick="updateCartQuantity(${index}, -1)" class="bg-gray-200 px-2 py-1 sm:px-3 sm:py-1 rounded text-sm">−</button>
                        <span class="mx-3 font-semibold text-sm sm:text-base">${item.quantity}</span>
                        <button onclick="updateCartQuantity(${index}, 1)" class="bg-gray-200 px-2 py-1 sm:px-3 sm:py-1 rounded text-sm">+</button>
                    </div>
                    <div class="text-base sm:text-lg font-bold">₹${itemTotal}</div>
                    <button onclick="removeCartItem(${index})" class="text-red-600 hover:text-red-800 text-sm sm:text-base">Remove</button>
                </div>
            </div>
        `;
    });
    
    cartHtml += `
        <div class="pt-4 sm:pt-6">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center space-y-4 sm:space-y-0">
                <span class="text-lg sm:text-xl font-bold">Total: ₹${total}</span>
                <button onclick="proceedToCheckout()" class="w-full sm:w-auto bg-curry text-white px-6 sm:px-8 py-3 rounded-full hover:bg-orange-600 transition text-center">
                    Proceed to Checkout
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
    
    // Create form and submit to checkout
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route('checkout') }}';
    form.innerHTML = `
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="cart" value='${JSON.stringify(cart)}'>
    `;
    document.body.appendChild(form);
    form.submit();
}

// Load cart on page load
loadCart();
</script>
@endsection
@extends('layouts.frontend')

@section('title', 'Cart - Desi Delights')

@section('content')
    <!-- Cart Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold text-center text-gray-800 mb-12">Your Cart</h1>
            
            <div id="cartContent" class="max-w-4xl mx-auto">
                <!-- Cart items will be loaded here by JavaScript -->
            </div>
            
            <div id="emptyCart" class="text-center py-16 hidden">
                <h2 class="text-2xl font-bold text-gray-600 mb-4">Your cart is empty</h2>
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
            <div class="flex items-center justify-between py-4 border-b">
                <div class="flex items-center">
                    <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                        <span class="text-gray-400">🍽️</span>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold">${item.name}</h3>
                        <p class="text-gray-600">₹${item.price} each</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <div class="flex items-center">
                        <button onclick="updateCartQuantity(${index}, -1)" class="bg-gray-200 px-3 py-1 rounded">-</button>
                        <span class="mx-3 font-semibold">${item.quantity}</span>
                        <button onclick="updateCartQuantity(${index}, 1)" class="bg-gray-200 px-3 py-1 rounded">+</button>
                    </div>
                    <div class="text-lg font-bold">₹${itemTotal}</div>
                    <button onclick="removeCartItem(${index})" class="text-red-600 hover:text-red-800">Remove</button>
                </div>
            </div>
        `;
    });
    
    cartHtml += `
        <div class="pt-6">
            <div class="flex justify-between items-center text-xl font-bold">
                <span>Total: ₹${total}</span>
                <button onclick="proceedToCheckout()" class="bg-curry text-white px-8 py-3 rounded-full hover:bg-orange-600 transition">
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
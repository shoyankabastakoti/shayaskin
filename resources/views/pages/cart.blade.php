@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<section class="py-12 bg-[#FFF9F7] min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="font-serif text-4xl text-[#2B2023] font-medium mb-10">Your Cart</h1>

        <div id="cart-container" class="grid lg:grid-cols-3 gap-10 hidden">
            <!-- Cart Items -->
            <div class="lg:col-span-2 space-y-6" id="cart-items">
                <!-- Injected via JS -->
            </div>

            <!-- Order Summary -->
            <div class="bg-white p-8 rounded-3xl border border-[#F6ECE8] h-fit">
                <h2 class="font-serif text-2xl text-[#2B2023] font-medium mb-6">Order Summary</h2>

                <div class="space-y-4 mb-6 text-sm text-[#76666B]">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span id="summary-subtotal" class="font-medium text-[#2B2023]">Rs. 0</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Delivery Charge</span>
                        <span class="font-medium text-[#2B2023]">Rs. 150</span>
                    </div>
                </div>

                <div class="border-t border-[#F6ECE8] pt-6 mb-8 flex justify-between">
                    <span class="text-lg font-medium text-[#2B2023]">Total</span>
                    <span id="summary-total" class="text-xl font-bold text-[#D94368]">Rs. 0</span>
                </div>

                <a href="{{ route('checkout') }}" class="block text-center w-full bg-[#D94368] hover:bg-[#B83253] text-white font-semibold py-4 rounded-xl transition-colors">
                    Proceed to Checkout
                </a>
            </div>
        </div>

        <!-- Empty State -->
        <div id="empty-cart" class="text-center py-20 hidden">
            <div class="w-24 h-24 mx-auto bg-[#F9ECE8] rounded-full flex items-center justify-center mb-6">
                <svg class="w-10 h-10 text-[#D94368]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
            <h2 class="font-serif text-2xl text-[#2B2023] font-medium mb-4">Your cart is empty</h2>
            <p class="text-[#76666B] mb-8">Looks like you haven't added anything yet.</p>
            <a href="{{ route('home') }}" class="inline-block bg-[#2B2023] hover:bg-[#D94368] text-white font-semibold px-8 py-3 rounded-xl transition-colors">
                Continue Shopping
            </a>
        </div>
    </div>
</section>

<script>
    function renderCart() {
        const cart = JSON.parse(localStorage.getItem('shaya_cart')) || [];
        const container = document.getElementById('cart-container');
        const emptyState = document.getElementById('empty-cart');
        const itemsContainer = document.getElementById('cart-items');

        if (cart.length === 0) {
            container.classList.add('hidden');
            emptyState.classList.remove('hidden');
            return;
        }

        container.classList.remove('hidden');
        emptyState.classList.add('hidden');

        let subtotal = 0;
        let html = '';

        cart.forEach((item, index) => {
            const itemTotal = item.price * item.quantity;
            subtotal += itemTotal;

            html += `
                <div class="flex gap-6 bg-white p-6 rounded-2xl border border-[#F6ECE8]">
                    <img src="${item.image}" alt="${item.name}" class="w-24 h-24 object-cover rounded-lg bg-[#F9ECE8]">
                    <div class="flex-1 flex flex-col justify-between">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-serif text-lg font-medium text-[#2B2023]">${item.name}</h3>
                                <p class="text-[#D94368] font-medium mt-1">Rs. ${item.price.toLocaleString()}</p>
                            </div>
                            <button onclick="removeItem(${item.id})" class="text-gray-400 hover:text-red-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                        <div class="flex items-center gap-4 mt-4">
                            <div class="flex items-center border border-[#F6ECE8] rounded-lg">
                                <button onclick="updateQty(${item.id}, -1)" class="px-3 py-1 text-[#76666B] hover:text-[#D94368]">-</button>
                                <span class="px-3 py-1 text-[#2B2023] font-medium">${item.quantity}</span>
                                <button onclick="updateQty(${item.id}, 1)" class="px-3 py-1 text-[#76666B] hover:text-[#D94368]">+</button>
                            </div>
                            <span class="text-sm text-[#76666B] ml-auto">Subtotal: <span class="font-medium text-[#2B2023]">Rs. ${itemTotal.toLocaleString()}</span></span>
                        </div>
                    </div>
                </div>
            `;
        });

        itemsContainer.innerHTML = html;

        const delivery = 150;
        document.getElementById('summary-subtotal').textContent = `Rs. ${subtotal.toLocaleString()}`;
        document.getElementById('summary-total').textContent = `Rs. ${(subtotal + delivery).toLocaleString()}`;

        updateCartCount();
    }

    function updateQty(id, change) {
        let cart = JSON.parse(localStorage.getItem('shaya_cart')) || [];
        let item = cart.find(i => i.id === id);
        if (item) {
            item.quantity += change;
            if (item.quantity <= 0) {
                cart = cart.filter(i => i.id !== id);
            }
            localStorage.setItem('shaya_cart', JSON.stringify(cart));
            renderCart();
        }
    }

    function removeItem(id) {
        let cart = JSON.parse(localStorage.getItem('shaya_cart')) || [];
        cart = cart.filter(i => i.id !== id);
        localStorage.setItem('shaya_cart', JSON.stringify(cart));
        renderCart();
    }

    document.addEventListener('DOMContentLoaded', renderCart);
</script>
@endsection

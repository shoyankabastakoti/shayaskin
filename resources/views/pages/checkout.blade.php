@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<section class="py-12 bg-[#FFF9F7] min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="font-serif text-4xl text-[#2B2023] font-medium mb-10">Place Your Order</h1>

        <form action="{{ route('checkout.submit') }}" method="POST" class="grid lg:grid-cols-3 gap-10">
            @csrf
            @error('cart_data')
                <p class="lg:col-span-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">{{ $message }}</p>
            @enderror
            <!-- Form Fields -->
            <div class="lg:col-span-2 space-y-8 bg-white p-8 rounded-3xl border border-[#F6ECE8]">

                <div>
                    <h2 class="font-serif text-2xl text-[#2B2023] font-medium mb-6">Customer Information</h2>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-[#76666B] mb-2">Full Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" required class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:outline-none focus:border-[#D94368] text-[#2B2023]">
                            @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-[#76666B] mb-2">Phone Number</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" required class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:outline-none focus:border-[#D94368] text-[#2B2023]">
                            @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-[#76666B] mb-2">Email Address</label>
                            <input type="email" name="email" value="{{ old('email') }}" required class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:outline-none focus:border-[#D94368] text-[#2B2023]">
                            @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="pt-6 border-t border-[#F6ECE8]">
                    <h2 class="font-serif text-2xl text-[#2B2023] font-medium mb-6">Delivery Address</h2>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-[#76666B] mb-2">Province</label>
                            <select name="province" required class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:outline-none focus:border-[#D94368] text-[#2B2023] bg-white">
                                <option value="">Select Province</option>
                                @foreach (['Bagmati', 'Gandaki', 'Lumbini'] as $province)
                                    <option value="{{ $province }}" @selected(old('province') === $province)>{{ $province }} Province</option>
                                @endforeach
                            </select>
                            @error('province') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-[#76666B] mb-2">District</label>
                            <input type="text" name="district" value="{{ old('district') }}" required class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:outline-none focus:border-[#D94368] text-[#2B2023]">
                            @error('district') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-[#76666B] mb-2">Municipality/City</label>
                            <input type="text" name="city" value="{{ old('city') }}" required class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:outline-none focus:border-[#D94368] text-[#2B2023]">
                            @error('city') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-[#76666B] mb-2">Ward Number</label>
                            <input type="number" name="ward" min="1" max="65535" value="{{ old('ward') }}" class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:outline-none focus:border-[#D94368] text-[#2B2023]">
                            @error('ward') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-[#76666B] mb-2">Full Delivery Address (Street/Tole)</label>
                            <input type="text" name="address" value="{{ old('address') }}" required class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:outline-none focus:border-[#D94368] text-[#2B2023]">
                            @error('address') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-[#76666B] mb-2">Optional Delivery Instructions</label>
                            <textarea name="instructions" rows="2" class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:outline-none focus:border-[#D94368] text-[#2B2023]">{{ old('instructions') }}</textarea>
                            @error('instructions') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="pt-6 border-t border-[#F6ECE8]">
                    <h2 class="font-serif text-2xl text-[#2B2023] font-medium mb-3">Payment Method</h2>
                    <p class="text-sm text-[#76666B]">Cash on delivery. Online payments are not enabled.</p>
                </div>

            </div>

            <!-- Order Summary Sidebar -->
            <div class="bg-white p-8 rounded-3xl border border-[#F6ECE8] h-fit sticky top-28">
                <h2 class="font-serif text-2xl text-[#2B2023] font-medium mb-6">Order Summary</h2>

                <div id="checkout-items" class="space-y-4 mb-6 max-h-60 overflow-y-auto">
                    <!-- Injected via JS -->
                </div>

                <div class="space-y-4 mb-6 text-sm text-[#76666B] border-t border-[#F6ECE8] pt-6">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span id="checkout-subtotal" class="font-medium text-[#2B2023]">Rs. 0</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Delivery Charge</span>
                        <span class="font-medium text-[#2B2023]">Rs. 150</span>
                    </div>
                </div>

                <div class="border-t border-[#F6ECE8] pt-6 mb-8 flex justify-between">
                    <span class="text-lg font-medium text-[#2B2023]">Total</span>
                    <span id="checkout-total" class="text-xl font-bold text-[#D94368]">Rs. 0</span>
                </div>

                <input type="hidden" name="cart_data" id="form-cart-data" value="[]">

                <button type="submit" class="w-full bg-[#D94368] hover:bg-[#B83253] text-white font-semibold py-4 rounded-xl transition-colors text-lg">
                    Place Order
                </button>
            </div>
        </form>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const cart = JSON.parse(localStorage.getItem('shaya_cart')) || [];
        if (cart.length === 0) {
            window.location.href = "{{ route('cart') }}";
            return;
        }

        const itemsContainer = document.getElementById('checkout-items');
        let subtotal = 0;
        let html = '';

        cart.forEach(item => {
            const itemTotal = item.price * item.quantity;
            subtotal += itemTotal;
            html += `
                <div class="flex justify-between text-sm">
                    <span class="text-[#76666B] pr-4">${item.quantity}x ${item.name}</span>
                    <span class="font-medium text-[#2B2023] whitespace-nowrap">Rs. ${itemTotal.toLocaleString()}</span>
                </div>
            `;
        });

        itemsContainer.innerHTML = html;
        const total = subtotal + 150;

        document.getElementById('checkout-subtotal').textContent = `Rs. ${subtotal.toLocaleString()}`;
        document.getElementById('checkout-total').textContent = `Rs. ${total.toLocaleString()}`;

        document.getElementById('form-cart-data').value = JSON.stringify(cart);
    });
</script>
@endsection

@extends('layouts.app')

@section('title', 'Order Confirmation')

@section('content')
<section class="py-20 bg-[#FFF9F7] min-h-screen flex items-center justify-center">
    <div class="max-w-3xl mx-auto px-4 w-full text-center">
        <div class="bg-white p-12 rounded-3xl border border-[#F6ECE8] shadow-sm">
            <div class="w-24 h-24 mx-auto bg-[#F9ECE8] rounded-full flex items-center justify-center mb-8">
                <span class="text-4xl">💗</span>
            </div>

            <h1 class="font-serif text-4xl sm:text-5xl text-[#2B2023] font-medium mb-4">Thank you for shopping with Shaya Skin!</h1>
            <p class="text-[#76666B] text-lg mb-10">Your order has been placed successfully.</p>

            <div class="bg-[#F9ECE8]/30 rounded-2xl p-8 text-left max-w-xl mx-auto mb-10">
                <h3 class="font-serif text-xl text-[#2B2023] font-medium mb-4 border-b border-[#F6ECE8] pb-4">Order Details</h3>

                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div class="text-[#76666B]">Order Number:</div>
                    <div class="font-medium text-[#2B2023]">{{ $order->order_number }}</div>

                    <div class="text-[#76666B]">Customer Name:</div>
                    <div class="font-medium text-[#2B2023]">{{ $order->customer_name }}</div>

                    <div class="text-[#76666B]">Total Amount:</div>
                    <div class="font-medium text-[#D94368]">Rs. {{ number_format($order->total_amount) }}</div>

                    <div class="text-[#76666B]">Payment Method:</div>
                    <div class="font-medium text-[#2B2023]">Cash on delivery</div>
                </div>

                <div class="mt-6 pt-6 border-t border-[#F6ECE8]">
                    <div class="text-[#76666B] text-sm mb-1">Delivery Address:</div>
                    <div class="font-medium text-[#2B2023] text-sm">
                        {{ $order->address }}, {{ $order->ward ? 'Ward '.$order->ward.', ' : '' }}<br>
                        {{ $order->city }}, {{ $order->district }}<br>
                        {{ $order->province }}
                    </div>
                </div>
            </div>

            <p class="text-[#76666B] mb-10 text-sm">Your order reference is {{ $order->order_number }}. We will contact you using the details you provided.</p>

            <a href="{{ route('home') }}" class="inline-block bg-[#D94368] hover:bg-[#B83253] text-white font-semibold px-10 py-4 rounded-xl transition-colors text-lg">
                Continue Shopping
            </a>
        </div>
    </div>
</section>

<script>
    // Clear the cart upon successful order confirmation
    document.addEventListener('DOMContentLoaded', () => {
        localStorage.removeItem('shaya_cart');
        const countEl = document.getElementById('cart-count');
        if(countEl) countEl.textContent = '0';
    });
</script>
@endsection

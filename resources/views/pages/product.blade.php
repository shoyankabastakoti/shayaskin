@extends('layouts.app')

@section('title', $product['name'])

@section('content')
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-12">
            <!-- Product Image -->
            <div class="bg-[#F9ECE8] rounded-3xl overflow-hidden">
                <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full h-full object-cover">
            </div>

            <!-- Product Details -->
            <div class="flex flex-col justify-center">
                <div class="mb-6">
                    <p class="text-[#D94368] text-sm font-bold tracking-wider uppercase mb-2">{{ $product['brand'] }}</p>
                    <h1 class="font-serif text-4xl text-[#2B2023] font-medium mb-4">{{ $product['name'] }}</h1>
                    <div class="flex items-center gap-4 mb-4">
                        <span class="text-2xl font-medium text-[#2B2023]">Rs. {{ number_format($product['price']) }}</span>
                        <div class="text-[#D94368] text-sm">★★★★★ <span class="text-[#76666B]">({{ $product['reviews'] }} reviews)</span></div>
                    </div>
                    <p class="text-[#76666B] text-lg leading-relaxed mb-6">{{ $product['description'] }}</p>

                    <div class="flex flex-wrap gap-2 mb-8">
                        <span class="bg-[#F9ECE8] text-[#D94368] text-xs font-bold uppercase tracking-wider px-3 py-1.5 rounded-full">{{ ucfirst($product['category']) }}</span>
                        <span class="bg-gray-100 text-gray-600 text-xs font-bold uppercase tracking-wider px-3 py-1.5 rounded-full">For {{ ucfirst($product['skin_type']) }} Skin</span>
                    </div>
                </div>

                <div class="flex gap-4 mb-10">
                    <button onclick="addToCartAndToast()" class="flex-1 bg-[#2B2023] hover:bg-[#D94368] text-white font-semibold py-4 rounded-xl transition-colors">
                        Add to Cart
                    </button>
                    <a href="{{ route('cart') }}" class="flex-1 text-center bg-[#D94368] hover:bg-[#B83253] text-white font-semibold py-4 rounded-xl transition-colors">
                        Buy Now
                    </a>
                </div>

                <!-- Info Accordions (Static for now) -->
                <div class="border-t border-[#F6ECE8] py-5">
                    <h3 class="font-serif text-lg text-[#2B2023] font-medium mb-2">Key Ingredients</h3>
                    <p class="text-[#76666B] text-sm">{{ $product['ingredients'] }}</p>
                </div>
                <div class="border-t border-[#F6ECE8] py-5">
                    <h3 class="font-serif text-lg text-[#2B2023] font-medium mb-2">Benefits</h3>
                    <p class="text-[#76666B] text-sm">{{ $product['benefits'] }}</p>
                </div>
                <div class="border-t border-b border-[#F6ECE8] py-5">
                    <h3 class="font-serif text-lg text-[#2B2023] font-medium mb-2">How to Use</h3>
                    <p class="text-[#76666B] text-sm">{{ $product['how_to_use'] }}</p>
                </div>

                <p class="text-xs text-gray-400 mt-6 italic">Product recommendations are based on general skin-type suitability and publicly available product information. Individual results may vary. Always check the product ingredients and follow the manufacturer’s instructions.</p>
            </div>
        </div>

        @if(count($related) > 0)
        <!-- Related Products -->
        <div class="mt-24">
            <h2 class="font-serif text-3xl text-[#2B2023] font-medium mb-8 text-center">You may also like</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($related as $p)
                <div class="group bg-white rounded-2xl overflow-hidden border border-[#F6ECE8] hover:shadow-lg hover:border-[#D94368]/30 transition-all">
                    <a href="{{ route('product', $p['id']) }}" class="block relative h-64 overflow-hidden bg-[#F9ECE8]">
                        <img src="{{ $p['image'] }}" alt="{{ $p['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </a>
                    <div class="p-5">
                        <p class="text-xs text-[#76666B] uppercase tracking-wider mb-1">{{ $p['brand'] }}</p>
                        <h3 class="font-serif text-lg font-medium text-[#2B2023] mb-2 leading-tight">
                            <a href="{{ route('product', $p['id']) }}" class="hover:text-[#D94368]">{{ $p['name'] }}</a>
                        </h3>
                        <span class="font-medium text-[#2B2023]">Rs. {{ number_format($p['price']) }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Toast -->
<div id="toast" class="fixed bottom-5 right-5 bg-[#2B2023] text-white px-6 py-3 rounded-lg shadow-xl transform translate-y-20 opacity-0 transition-all duration-300 z-50">
    <span id="toast-message">Added to cart</span>
</div>

<script>
    function addToCartAndToast() {
        let cart = JSON.parse(localStorage.getItem('shaya_cart')) || [];
        let id = {{ $product['id'] }};
        let item = cart.find(i => i.id === id);
        if (item) {
            item.quantity++;
        } else {
            cart.push({
                id: id,
                name: "{{ addslashes($product['name']) }}",
                price: {{ $product['price'] }},
                image: "{{ $product['image'] }}",
                quantity: 1
            });
        }
        localStorage.setItem('shaya_cart', JSON.stringify(cart));
        updateCartCount();

        // Show toast
        const toast = document.getElementById('toast');
        document.getElementById('toast-message').textContent = "{{ addslashes($product['name']) }} has been added to your cart.";
        toast.classList.remove('translate-y-20', 'opacity-0');
        setTimeout(() => toast.classList.add('translate-y-20', 'opacity-0'), 3000);
    }

    function updateCartCount() {
        let cart = JSON.parse(localStorage.getItem('shaya_cart')) || [];
        let count = cart.reduce((sum, item) => sum + item.quantity, 0);
        const countEl = document.getElementById('cart-count');
        if(countEl) countEl.textContent = count;
    }

    document.addEventListener('DOMContentLoaded', updateCartCount);
</script>
@endsection

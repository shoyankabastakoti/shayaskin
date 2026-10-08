@extends('layouts.app')

@section('title', 'Shop Products')

@section('content')
<section class="py-12 bg-[#FFF9F7]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
            <div>
                <h1 class="font-serif text-4xl text-[#2B2023] font-medium">Recommended Products</h1>
                <p class="text-[#76666B] mt-2">Showing products for your skin type.</p>
            </div>

            <form action="{{ route('shop') }}" method="GET" class="flex gap-4 w-full md:w-auto">
                @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
                @if(request('skin_type')) <input type="hidden" name="skin_type" value="{{ request('skin_type') }}"> @endif
                @if(request('q')) <input type="hidden" name="q" value="{{ request('q') }}"> @endif
                <select name="sort" onchange="this.form.submit()" class="border border-[#F6ECE8] bg-white rounded-lg px-4 py-2 text-[#2B2023] focus:outline-none focus:border-[#D94368]">
                    <option value="">Recommended</option>
                    <option value="price_low" @if(request('sort') == 'price_low') selected @endif>Price: Low to High</option>
                    <option value="price_high" @if(request('sort') == 'price_high') selected @endif>Price: High to Low</option>
                    <option value="rating" @if(request('sort') == 'rating') selected @endif>Highest Rated</option>
                </select>
            </form>
        </div>

        <div class="grid grid-cols-2 gap-6 lg:grid-cols-3 lg:gap-8">
            @forelse($products as $p)
                <div class="group bg-white rounded-2xl overflow-hidden border border-[#F6ECE8] hover:shadow-lg hover:border-[#D94368]/30 transition-all">
                    <a href="{{ route('product', $p['id']) }}" class="block relative h-64 overflow-hidden bg-[#F9ECE8]">
                        <img src="{{ $p['image'] }}" alt="{{ $p['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-3 left-3 bg-white text-[#D94368] text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-full shadow-sm">{{ ucfirst($p['skin_type']) }}</span>
                    </a>
                    <div class="p-5">
                        <div class="text-[#D94368] text-sm mb-1">★★★★★ <span class="text-[#76666B]">({{ $p['reviews'] }})</span></div>
                        <p class="text-xs text-[#76666B] uppercase tracking-wider mb-1">{{ $p['brand'] }}</p>
                        <h3 class="font-serif text-lg font-medium text-[#2B2023] mb-2 leading-tight">
                            <a href="{{ route('product', $p['id']) }}" class="hover:text-[#D94368]">{{ $p['name'] }}</a>
                        </h3>
                        <div class="flex items-center justify-between mt-4">
                            <span class="font-medium text-[#2B2023]">Rs. {{ number_format($p['price']) }}</span>
                            <button onclick="addToCart({{ $p['id'] }}, '{{ addslashes($p['name']) }}', {{ $p['price'] }}, '{{ $p['image'] }}')" class="bg-[#F9ECE8] hover:bg-[#D94368] text-[#D94368] hover:text-white w-10 h-10 rounded-full flex items-center justify-center transition-colors">
                                +
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20">
                    <p class="text-[#76666B] text-xl">No products found matching your criteria.</p>
                </div>
            @endforelse
        </div>

    </div>
</section>

<!-- Toast -->
<div id="toast" class="fixed bottom-5 right-5 bg-[#2B2023] text-white px-6 py-3 rounded-lg shadow-xl transform translate-y-20 opacity-0 transition-all duration-300 z-50">
    <span id="toast-message">Added to cart</span>
</div>

<script>
    function addToCart(id, name, price, image) {
        let cart = JSON.parse(localStorage.getItem('shaya_cart')) || [];
        let item = cart.find(i => i.id === id);
        if (item) {
            item.quantity++;
        } else {
            cart.push({ id, name, price, image, quantity: 1 });
        }
        localStorage.setItem('shaya_cart', JSON.stringify(cart));
        updateCartCount();

        // Show toast
        const toast = document.getElementById('toast');
        document.getElementById('toast-message').textContent = name + " has been added to your cart.";
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

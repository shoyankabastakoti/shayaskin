@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-[600px] overflow-hidden bg-[#F9ECE8] bg-cover bg-[position:60%_center] py-20 lg:py-32" style="background-image: url('{{ asset('images/hero.jpg') }}')">
    <div class="absolute inset-0 bg-gradient-to-r from-[#F9ECE8]/95 via-[#F9ECE8]/85 to-[#F9ECE8]/20"></div>
    <div class="absolute inset-0 bg-black/10"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl">
            <h1 class="font-serif text-5xl sm:text-6xl lg:text-7xl text-[#2B2023] leading-tight mb-6">
                Your Skin.<br>
                <span class="text-[#D94368] italic font-light">Your Beauty.</span><br>
                Your Shaya.
            </h1>
            <p class="text-[#76666B] text-lg sm:text-xl mb-10 leading-relaxed max-w-lg">
                Discover premium skincare and makeup carefully selected for your unique skin type.
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('skin-type', ['category' => 'skincare']) }}" class="text-center bg-[#D94368] hover:bg-[#B83253] text-white font-semibold px-8 py-4 rounded-full transition-colors text-lg shadow-lg shadow-[#D94368]/30 hover:-translate-y-1 duration-300">
                    Shop Skincare
                </a>
                <a href="{{ route('skin-type', ['category' => 'makeup']) }}" class="text-center bg-white hover:bg-[#F6ECE8] text-[#2B2023] font-semibold px-8 py-4 rounded-full transition-colors text-lg shadow-sm border border-[#F6ECE8] hover:-translate-y-1 duration-300">
                    Shop Makeup
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Best Sellers -->
<section class="bg-white py-20 lg:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-10 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="mb-3 text-sm font-bold uppercase tracking-wider text-[#D94368]">Loved by your skin</p>
                <h2 class="font-serif text-4xl text-[#2B2023] sm:text-5xl">Our Best Sellers</h2>
            </div>
            <a href="{{ route('shop') }}" class="font-semibold text-[#D94368] transition-colors hover:text-[#B83253]">
                Shop all products <span aria-hidden="true">&rarr;</span>
            </a>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @forelse($bestSellers as $product)
                <article class="group overflow-hidden rounded-2xl border border-[#F6ECE8] bg-white transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <a href="{{ route('product', $product['id']) }}" class="block">
                        <div class="relative aspect-[4/5] overflow-hidden bg-[#F9ECE8]">
                            <img
                                src="{{ $product['image'] }}"
                                alt="{{ $product['name'] }}"
                                loading="lazy"
                                class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                            >
                            <span class="absolute left-3 top-3 rounded-full bg-white/90 px-3 py-1 text-[10px] font-bold uppercase tracking-wider text-[#D94368]">
                                Best Seller
                            </span>
                        </div>
                        <div class="p-5">
                            <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-[#D94368]">{{ $product['category'] }}</p>
                            <h3 class="mb-2 font-serif text-xl font-semibold text-[#2B2023] transition-colors group-hover:text-[#D94368]">{{ $product['name'] }}</h3>
                            <p class="mb-5 text-sm leading-relaxed text-[#76666B]">{{ $product['description'] }}</p>
                            <span class="inline-flex items-center justify-between gap-2 font-semibold text-[#2B2023]">
                                Rs. {{ number_format($product['price']) }}
                                <span class="text-[#D94368]">View product <span aria-hidden="true">&rarr;</span></span>
                            </span>
                        </div>
                    </a>
                </article>
            @empty
                <p class="col-span-full text-center text-[#76666B]">Products will appear here once the catalog has been initialized.</p>
            @endforelse
        </div>
    </div>
</section>

<!-- Shop by Skin Type -->
<section class="py-24 bg-[#FFF9F7]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-[#D94368] text-sm font-bold tracking-wider uppercase mb-3">Personalized For You</p>
        <h2 class="font-serif text-4xl sm:text-5xl text-[#2B2023] mb-16">Shop according to your skin type</h2>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Oily Skin -->
            <div class="group bg-white rounded-[2rem] p-8 border border-[#F6ECE8] hover:border-[#D94368]/50 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                <div class="mb-8 grid grid-cols-3 gap-2">
                    @foreach([
                        ['image' => 'skincare1', 'name' => 'Heartleaf Cleansing Foam', 'price' => 2150],
                        ['image' => 'skincare2', 'name' => 'Moisturizing Lotion', 'price' => 2400],
                        ['image' => 'skincare3', 'name' => 'Lactic Acid Serum', 'price' => 1450],
                    ] as $product)
                        <div class="overflow-hidden rounded-xl bg-[#F9ECE8] text-left">
                            <img
                                src="{{ asset('images/' . $product['image'] . '.jpg') }}"
                                alt="{{ $product['name'] }}"
                                loading="lazy"
                                class="aspect-[3/4] w-full object-cover"
                            >
                            <div class="p-2">
                                <p class="min-h-10 text-[10px] font-medium leading-tight text-[#2B2023]">{{ $product['name'] }}</p>
                                <p class="mt-1 text-xs font-bold text-[#D94368]">Rs. {{ number_format($product['price']) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <h3 class="font-serif text-2xl font-bold text-[#2B2023] mb-3">Oily Skin</h3>
                <p class="text-[#76666B] mb-8 leading-relaxed">Balance excess oil and minimize pores with our lightweight, non-comedogenic formulas.</p>
                <a href="{{ route('shop', ['skin_type' => 'oily', 'category' => 'all']) }}" class="inline-block border-b-2 border-[#D94368] text-[#D94368] font-bold uppercase tracking-wider pb-1 hover:text-[#B83253] hover:border-[#B83253] transition-colors">
                    Explore Products →
                </a>
            </div>

            <!-- Combination Skin -->
            <div class="group bg-white rounded-[2rem] p-8 border border-[#F6ECE8] hover:border-[#D94368]/50 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                <div class="relative h-64 mb-8 overflow-hidden rounded-2xl bg-[#F9ECE8]">
                    <img src="https://images.unsplash.com/photo-1620916566398-39f1143ab7be?auto=format&fit=crop&q=80&w=400" alt="Combination skin products" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                </div>
                <h3 class="font-serif text-2xl font-bold text-[#2B2023] mb-3">Combination Skin</h3>
                <p class="text-[#76666B] mb-8 leading-relaxed">Find the perfect harmony for oily T-zones and dry cheeks with our balancing products.</p>
                <a href="{{ route('shop', ['skin_type' => 'combination', 'category' => 'all']) }}" class="inline-block border-b-2 border-[#D94368] text-[#D94368] font-bold uppercase tracking-wider pb-1 hover:text-[#B83253] hover:border-[#B83253] transition-colors">
                    Explore Products →
                </a>
            </div>

            <!-- Dry Skin -->
            <div class="group bg-white rounded-[2rem] p-8 border border-[#F6ECE8] hover:border-[#D94368]/50 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                <div class="relative h-64 mb-8 overflow-hidden rounded-2xl bg-[#F9ECE8]">
                    <img src="https://images.unsplash.com/photo-1599305090598-fe179d501227?auto=format&fit=crop&q=80&w=400" alt="Dry skin products" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                </div>
                <h3 class="font-serif text-2xl font-bold text-[#2B2023] mb-3">Dry Skin</h3>
                <p class="text-[#76666B] mb-8 leading-relaxed">Deeply hydrate and restore your skin's protective barrier with our rich, nourishing formulas.</p>
                <a href="{{ route('shop', ['skin_type' => 'dry', 'category' => 'all']) }}" class="inline-block border-b-2 border-[#D94368] text-[#D94368] font-bold uppercase tracking-wider pb-1 hover:text-[#B83253] hover:border-[#B83253] transition-colors">
                    Explore Products →
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="py-20 bg-white border-t border-[#F6ECE8]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-4xl mb-4">🌿</div>
                <h4 class="font-bold text-[#2B2023] mb-2">Clean Ingredients</h4>
                <p class="text-sm text-[#76666B]">Safe for your skin and the environment.</p>
            </div>
            <div>
                <div class="text-4xl mb-4">🐰</div>
                <h4 class="font-bold text-[#2B2023] mb-2">Cruelty Free</h4>
                <p class="text-sm text-[#76666B]">Never tested on animals, ever.</p>
            </div>
            <div>
                <div class="text-4xl mb-4">👩‍🔬</div>
                <h4 class="font-bold text-[#2B2023] mb-2">Dermatologist Tested</h4>
                <p class="text-sm text-[#76666B]">Clinically proven and safe formulas.</p>
            </div>
            <div>
                <div class="text-4xl mb-4">✨</div>
                <h4 class="font-bold text-[#2B2023] mb-2">Premium Quality</h4>
                <p class="text-sm text-[#76666B]">The best for your skin type.</p>
            </div>
        </div>
    </div>
</section>
@endsection

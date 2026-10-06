@extends('layouts.app')

@section('title', 'Shaya Skin')
@section('meta_description', 'Shaya Skin — Premium skincare and makeup crafted for every skin type. Glow naturally, shine confidently.')

@section('content')

    {{-- ── HERO ──────────────────────────────────────────────────── --}}
    <section aria-label="Hero" class="relative bg-gradient-to-br from-rose-50 via-pink-50 to-rose-100 overflow-hidden">
        {{-- Background circle decoration --}}
        <div class="pointer-events-none absolute -top-24 -right-24 w-[500px] h-[500px] rounded-full bg-pink-200/40 blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28">
            <div class="grid lg:grid-cols-2 gap-12 items-center">

                {{-- Copy --}}
                <div class="relative z-10">
                    <p class="flex items-center gap-2.5 text-rose-500 text-[10px] font-semibold tracking-[0.2em] uppercase mb-5">
                        <span class="block w-6 h-px bg-rose-400"></span> NEW COLLECTION 2025
                    </p>
                    <h1 class="font-serif text-5xl sm:text-6xl lg:text-7xl font-medium tracking-tight leading-[1.04] text-stone-800 mb-6">
                        Glow Naturally.<br><em class="text-rose-500 not-italic font-normal">Shine Confidently.</em>
                    </h1>
                    <p class="text-stone-500 text-lg leading-relaxed max-w-md mb-9">
                        Skincare and beauty essentials that bring out your natural radiance. Made for real skin, every day — clean, cruelty-free &amp; dermatologist tested.
                    </p>
                    <div class="flex flex-wrap gap-4 mb-12">
                        <a href="{{ route('skincare') }}" id="hero-shop-btn"
                           class="inline-flex items-center gap-2 bg-rose-500 hover:bg-rose-600 text-white text-sm font-semibold uppercase tracking-widest px-7 py-3.5 rounded-lg shadow-lg shadow-rose-200 hover:shadow-rose-300 transition-all duration-200 hover:-translate-y-0.5">
                            Shop Now →
                        </a>
                        <a href="{{ route('makeup') }}" id="hero-explore-btn"
                           class="inline-flex items-center gap-2 border-2 border-rose-400 text-rose-500 hover:bg-rose-500 hover:text-white text-sm font-semibold uppercase tracking-widest px-7 py-3.5 rounded-lg transition-all duration-200 hover:-translate-y-0.5">
                            Explore Makeup →
                        </a>
                    </div>

                    {{-- Badges --}}
                    <div class="flex flex-wrap gap-6">
                        @foreach([['🌿','Clean','Ingredients'],['🐰','Cruelty','Free'],['🧪','Dermatologist','Tested'],['✨','All Skin','Types']] as [$icon,$l1,$l2])
                        <div class="flex flex-col items-center gap-1.5 text-center">
                            <span class="text-2xl">{{ $icon }}</span>
                            <span class="text-[9px] font-semibold uppercase tracking-wide text-stone-500 leading-tight">{{ $l1 }}<br>{{ $l2 }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Hero image --}}
                <div class="relative flex justify-center lg:justify-end">
                    <div class="relative w-full max-w-sm lg:max-w-md">
                        <img src="{{ asset('images/products/hero_model.jpg') }}"
                             alt="Woman with glowing skin using Shaya Skin products"
                             class="w-full h-[420px] lg:h-[520px] object-cover rounded-3xl shadow-2xl shadow-rose-200/60">

                        {{-- Floating product card --}}
                        <div class="absolute -bottom-5 -left-5 sm:left-0 flex items-center gap-3 bg-white rounded-2xl px-4 py-3 shadow-xl animate-bounce-slow">
                            <img src="{{ asset('images/products/shaya_serum.jpg') }}" alt="Daily Glow Serum" class="w-12 h-12 rounded-xl object-cover">
                            <div>
                                <p class="text-sm font-semibold text-stone-800">Daily Glow Serum</p>
                                <p class="text-[10px] text-amber-400">★★★★★</p>
                                <p class="text-base font-bold text-rose-500">$42.00</p>
                            </div>
                        </div>

                        {{-- Slide dots --}}
                        <div class="absolute -bottom-5 right-4 flex gap-1.5 items-center">
                            <span class="w-5 h-1.5 rounded bg-rose-400"></span>
                            <span class="w-1.5 h-1.5 rounded-full bg-rose-200"></span>
                            <span class="w-1.5 h-1.5 rounded-full bg-rose-200"></span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ── TRUST BAR ────────────────────────────────────────────── --}}
    <section aria-label="Why Shaya Skin" class="bg-white border-y border-rose-100">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 divide-x divide-rose-100">
                @foreach([
                    ['📦','Free Shipping','On orders over $50'],
                    ['🔄','Easy Returns','30-day return policy'],
                    ['🔒','Secure Payment','100% safe checkout'],
                    ['💬','Customer Support','Always here to help'],
                ] as [$icon,$title,$sub])
                <div class="flex items-center gap-3 px-6 py-6">
                    <span class="text-2xl shrink-0">{{ $icon }}</span>
                    <div>
                        <p class="text-base font-semibold text-stone-800">{{ $title }}</p>
                        <p class="text-sm text-stone-400">{{ $sub }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── SHOP BY CATEGORY ─────────────────────────────────────── --}}
    <section aria-labelledby="cat-heading" class="py-20 lg:py-28 bg-rose-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14">
                <p class="flex items-center justify-center gap-2.5 text-rose-500 text-[10px] font-semibold tracking-[0.2em] uppercase mb-3">
                    <span class="block w-5 h-px bg-rose-400"></span> EXPLORE OUR RANGE
                </p>
                <h2 id="cat-heading" class="font-serif text-4xl sm:text-5xl font-medium tracking-tight text-stone-800">Shop by Category</h2>
                <div class="w-12 h-0.5 bg-rose-400 mx-auto mt-4"></div>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                {{-- Skincare --}}
                <a href="{{ route('skincare') }}" id="cat-skincare" class="group block rounded-2xl overflow-hidden shadow-md hover:shadow-2xl hover:shadow-rose-100 transition-all duration-300 hover:-translate-y-1">
                    <div class="relative h-64 sm:h-72 overflow-hidden">
                        <img src="{{ asset('images/products/skincare_products.jpg') }}" alt="Skincare collection"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-stone-900/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                            <span class="text-white text-sm font-semibold uppercase tracking-widest">Shop Now →</span>
                        </div>
                    </div>
                    <div class="bg-white px-6 py-5">
                        <h3 class="font-serif text-2xl font-medium text-stone-800 mb-1">Skincare</h3>
                        <p class="text-stone-400 text-sm">Serums, moisturisers, toners &amp; more</p>
                    </div>
                </a>

                {{-- Makeup --}}
                <a href="{{ route('makeup') }}" id="cat-makeup" class="group block rounded-2xl overflow-hidden shadow-md hover:shadow-2xl hover:shadow-rose-100 transition-all duration-300 hover:-translate-y-1">
                    <div class="relative h-64 sm:h-72 overflow-hidden">
                        <img src="{{ asset('images/products/makeup_products.jpg') }}" alt="Makeup collection"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-stone-900/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                            <span class="text-white text-sm font-semibold uppercase tracking-widest">Shop Now →</span>
                        </div>
                    </div>
                    <div class="bg-white px-6 py-5">
                        <h3 class="font-serif text-2xl font-medium text-stone-800 mb-1">Makeup</h3>
                        <p class="text-stone-400 text-sm">Foundation, lipstick, eyeshadow &amp; more</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

    {{-- ── BEST SELLERS STRIP ───────────────────────────────────── --}}
    <section aria-labelledby="bs-heading" class="py-20 lg:py-28 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14">
                <p class="flex items-center justify-center gap-2.5 text-rose-500 text-[10px] font-semibold tracking-[0.2em] uppercase mb-3">
                    <span class="block w-5 h-px bg-rose-400"></span> CUSTOMER FAVOURITES
                </p>
                <h2 id="bs-heading" class="font-serif text-4xl sm:text-5xl font-medium tracking-tight text-stone-800">Best Sellers</h2>
                <div class="w-12 h-0.5 bg-rose-400 mx-auto mt-4"></div>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-7">
                @foreach([
                    ['shaya_serum','Daily Glow Serum','Vitamin C + Hyaluronic Acid','$42.00','NEW','128','skincare'],
                    ['hydra_cream','Hydra Moisture Cream','Ceramide & Peptide complex','$36.00','BEST SELLER','96','skincare'],
                    ['luminous_foundation','Luminous Foundation','SPF 20 hydrating radiant finish','$34.00','BEST SELLER','74','makeup'],
                ] as [$img,$name,$desc,$price,$tag,$reviews,$page])
                <article class="group bg-rose-50 rounded-2xl overflow-hidden hover:shadow-xl hover:shadow-rose-100 transition-all duration-300 hover:-translate-y-1">
                    <div class="relative h-60 overflow-hidden bg-rose-100">
                        <img src="{{ asset('images/products/' . $img . '.jpg') }}" alt="{{ $name }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-3 left-3 bg-rose-500 text-white text-[9px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full">
                            {{ $tag }}
                        </span>
                        <button class="absolute bottom-0 left-0 right-0 bg-stone-800/85 backdrop-blur text-white text-sm font-semibold uppercase tracking-wider py-3 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                            + Add to Cart
                        </button>
                    </div>
                    <div class="p-5 bg-white">
                        <div class="text-amber-400 text-base mb-1">★★★★★ <span class="text-stone-400 text-sm">({{ $reviews }})</span></div>
                        <h3 class="font-serif text-xl font-medium text-stone-800 mb-1">{{ $name }}</h3>
                        <p class="text-stone-400 text-sm mb-4">{{ $desc }}</p>
                        <div class="flex items-center justify-between">
                            <span class="font-serif text-xl font-semibold text-rose-500">{{ $price }}</span>
                            <a href="{{ route($page) }}" class="text-sm font-semibold text-stone-400 hover:text-rose-500 transition-colors duration-150">Shop →</a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('skincare') }}" id="home-view-all"
                   class="inline-flex items-center gap-2 border-2 border-rose-400 text-rose-500 hover:bg-rose-500 hover:text-white text-sm font-semibold uppercase tracking-widest px-7 py-3 rounded-lg transition-all duration-200">
                    View All Products →
                </a>
            </div>
        </div>
    </section>

    {{-- ── ABOUT TEASER ─────────────────────────────────────────── --}}
    <section aria-labelledby="about-teaser-heading" class="py-20 lg:py-28 bg-rose-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="text-rose-400 text-2xl">✳︎</span>
            <p class="flex items-center justify-center gap-2.5 text-rose-500 text-[10px] font-semibold tracking-[0.2em] uppercase mt-4 mb-4">
                <span class="block w-5 h-px bg-rose-400"></span> A NOTE FROM SHAYA
            </p>
            <h2 id="about-teaser-heading" class="font-serif text-4xl sm:text-5xl font-medium tracking-tight text-stone-800 mb-6">
                Good skin isn't a look.<br><em class="text-rose-500 not-italic font-normal">It's feeling like yourself.</em>
            </h2>
            <p class="text-stone-500 text-lg leading-relaxed mb-8 max-w-xl mx-auto">
                We believe the best beauty routine is the one that feels like yours. No pressure, no rules — just thoughtful essentials to help you feel at home in your skin.
            </p>
            <a href="{{ route('about') }}" id="home-about-btn"
               class="inline-flex items-center gap-2 bg-rose-500 hover:bg-rose-600 text-white text-sm font-semibold uppercase tracking-widest px-7 py-3.5 rounded-lg shadow-lg shadow-rose-200 transition-all duration-200 hover:-translate-y-0.5">
                Our Story →
            </a>
        </div>
    </section>

    {{-- ── TESTIMONIALS ─────────────────────────────────────────── --}}
    <section aria-labelledby="reviews-heading" class="py-20 lg:py-28 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14">
                <p class="flex items-center justify-center gap-2.5 text-rose-500 text-[10px] font-semibold tracking-[0.2em] uppercase mb-3">
                    <span class="block w-5 h-px bg-rose-400"></span> CUSTOMER LOVE
                </p>
                <h2 id="reviews-heading" class="font-serif text-4xl sm:text-5xl font-medium tracking-tight text-stone-800">What Our Customers Say</h2>
                <div class="w-12 h-0.5 bg-rose-400 mx-auto mt-4"></div>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-7">
                @foreach([
                    ['"The Daily Glow Serum completely transformed my skin. I\'ve never felt so confident going makeup-free!"','Priya S., Mumbai'],
                    ['"I love that everything is cruelty-free. The Hydra Cream keeps my skin hydrated all day — absolute game changer."','Aisha M., Dubai'],
                    ['"Shaya Skin\'s foundation is the only one I\'ve found that actually matches and lasts all day. Obsessed!"','Sarah L., London'],
                ] as [$quote,$author])
                <blockquote class="bg-rose-50 rounded-2xl p-7 border-l-4 border-rose-400 hover:shadow-lg hover:shadow-rose-100 transition-all duration-300 hover:-translate-y-1">
                    <div class="text-amber-400 text-lg mb-4">★★★★★</div>
                    <p class="text-stone-600 text-base leading-relaxed italic mb-5">{{ $quote }}</p>
                    <footer class="text-sm font-semibold text-stone-800">— <cite class="not-italic">{{ $author }}</cite></footer>
                </blockquote>
                @endforeach
            </div>
        </div>
    </section>

@endsection

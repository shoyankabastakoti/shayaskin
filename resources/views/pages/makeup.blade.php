@extends('layouts.app')

@section('title', 'Makeup')
@section('meta_description', 'Shop Shaya Skin makeup collection. Discover foundations, lipsticks, and palettes designed to enhance your natural beauty.')

@section('content')

    {{-- ── PAGE HERO ─────────────────────────────────────────────── --}}
    <section class="relative bg-gradient-to-br from-[#F9ECE8] via-[#FFF9F7] to-[#F6ECE8] py-20 overflow-hidden" aria-label="Makeup hero">
        <div class="pointer-events-none absolute -top-16 -left-16 w-80 h-80 rounded-full bg-[#D94368]/10 blur-3xl"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1 relative flex justify-center lg:justify-start">
                    <img src="{{ asset('images/products/makeup_products.jpg') }}" alt="Shaya Skin makeup collection"
                         class="w-full max-w-md h-72 lg:h-80 object-cover rounded-3xl shadow-2xl shadow-[#D94368]/15">
                </div>
                <div class="order-1 lg:order-2">
                    <p class="flex items-center gap-2.5 text-[#D94368] text-[10px] font-semibold tracking-[0.2em] uppercase mb-4">
                        <span class="block w-5 h-px bg-[#D94368]"></span> MAKEUP COLLECTION
                    </p>
                    <h1 class="font-serif text-5xl sm:text-6xl font-medium tracking-tight leading-[1.05] text-[#2B2023] mb-5">
                        Enhance.<br><em class="text-[#D94368] not-italic font-normal">Express.</em>
                    </h1>
                    <p class="text-[#76666B] text-lg leading-relaxed max-w-md mb-8">
                        Makeup that celebrates your unique features. Buildable coverage, skin-loving ingredients, and shades for everyone.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        @foreach(['Face','Eyes','Lips','Palettes','Sets'] as $cat)
                        <span class="bg-white border border-[#F6ECE8] text-[#D94368] text-sm font-medium px-4 py-1.5 rounded-full hover:bg-[#D94368] hover:text-white cursor-pointer transition-colors duration-150">{{ $cat }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── PRODUCTS GRID ───────────────────────────────────────── --}}
    <section aria-labelledby="makeup-products-heading" class="py-20 lg:py-28 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-12">
                <div>
                    <h2 id="makeup-products-heading" class="font-serif text-3xl sm:text-4xl font-medium text-[#2B2023]">All Makeup Products</h2>
                    <p class="text-[#76666B] text-base mt-1">4 products</p>
                </div>
                <select id="sort-makeup" aria-label="Sort products"
                        class="border border-[#F6ECE8] rounded-lg px-4 py-2 text-base text-[#76666B] focus:outline-none focus:ring-2 focus:ring-[#D94368]/30 bg-white">
                    <option>Sort: Featured</option>
                    <option>Price: Low to High</option>
                    <option>Price: High to Low</option>
                    <option>Best Sellers</option>
                </select>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-7">
                @foreach([
                    ['luminous_foundation','Luminous Foundation','SPF 20 hydrating radiant finish. Buildable coverage that lasts all day.','$34.00','BEST SELLER','74'],
                    ['makeup_products','Glow Makeup Collection','Eyeshadow, blush, lipstick & mascara bundle for a complete look.','$68.00','NEW','58'],
                    ['luminous_foundation','Soft Velvet Lipstick','12-hour wear, ultra-pigmented, available in 16 inclusive shades.','$28.00','','110'],
                    ['makeup_products','Radiant Blush Palette','Four complementary shades to sculpt and add a natural flush.','$45.00','TRENDING','89'],
                ] as [$img,$name,$desc,$price,$tag,$reviews])
                <article class="group bg-[#FFF9F7] rounded-2xl overflow-hidden hover:shadow-xl hover:shadow-[#D94368]/10 transition-all duration-300 hover:-translate-y-1" id="product-{{ Str::slug($name) }}">
                    <div class="relative h-64 overflow-hidden bg-[#F9ECE8]">
                        <img src="{{ asset('images/products/' . $img . '.jpg') }}" alt="{{ $name }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @if($tag)
                        <span class="absolute top-3 left-3 bg-[#D94368] text-white text-[9px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full">{{ $tag }}</span>
                        @endif
                        <button class="quick-add-btn absolute bottom-0 left-0 right-0 bg-[#2B2023]/85 backdrop-blur text-white text-sm font-semibold uppercase tracking-wider py-3.5 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                            + Add to Cart
                        </button>
                    </div>
                    <div class="p-5 bg-white">
                        <div class="text-amber-400 text-base mb-1">★★★★★ <span class="text-[#76666B] text-sm">({{ $reviews }})</span></div>
                        <h3 class="font-serif text-xl font-medium text-[#2B2023] mb-1.5">{{ $name }}</h3>
                        <p class="text-[#76666B] text-sm leading-relaxed mb-4">{{ $desc }}</p>
                        <div class="flex items-center justify-between">
                            <span class="font-serif text-xl font-semibold text-[#D94368]">{{ $price }}</span>
                            <button class="quick-add-btn bg-[#D94368] hover:bg-[#B83253] text-white text-[10px] font-semibold uppercase tracking-wider px-3.5 py-1.5 rounded-lg transition-colors duration-150">
                                Add →
                            </button>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    document.querySelectorAll('.quick-add-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const orig = btn.textContent;
            btn.textContent = '✓ Added!';
            btn.classList.add('bg-green-500');
            btn.classList.remove('bg-[#D94368]', 'hover:bg-[#B83253]');
            setTimeout(() => {
                btn.textContent = orig;
                btn.classList.remove('bg-green-500');
                btn.classList.add('bg-[#D94368]', 'hover:bg-[#B83253]');
            }, 2000);
        });
    });
</script>
@endpush

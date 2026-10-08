@extends('layouts.app')

@section('title', 'Skincare')
@section('meta_description', 'Shop Shaya Skin skincare collection — serums, moisturisers, toners and more. Clean, cruelty-free formulas for every skin type.')

@section('content')

    {{-- ── PAGE HERO ─────────────────────────────────────────────── --}}
    <section class="relative bg-gradient-to-br from-[#F9ECE8] via-[#FFF9F7] to-[#F6ECE8] py-20 overflow-hidden" aria-label="Skincare hero">
        <div class="pointer-events-none absolute -top-16 -right-16 w-80 h-80 rounded-full bg-[#D94368]/10 blur-3xl"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <p class="flex items-center gap-2.5 text-[#D94368] text-[10px] font-semibold tracking-[0.2em] uppercase mb-4">
                        <span class="block w-5 h-px bg-[#D94368]"></span> SKINCARE COLLECTION
                    </p>
                    <h1 class="font-serif text-5xl sm:text-6xl font-medium tracking-tight leading-[1.05] text-[#2B2023] mb-5">
                        Your skin.<br><em class="text-[#D94368] not-italic font-normal">Your ritual.</em>
                    </h1>
                    <p class="text-[#76666B] text-lg leading-relaxed max-w-md mb-8">
                        Thoughtfully formulated skincare that works with your skin, not against it. Clean ingredients, real results.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        @foreach(['Serums','Moisturisers','Toners','SPF','Sets'] as $cat)
                        <span class="bg-white border border-[#F6ECE8] text-[#D94368] text-sm font-medium px-4 py-1.5 rounded-full hover:bg-[#D94368] hover:text-white cursor-pointer transition-colors duration-150">{{ $cat }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="relative flex justify-center lg:justify-end">
                    <img src="{{ asset('images/products/skincare_products.jpg') }}" alt="Shaya Skin skincare collection"
                         class="w-full max-w-md h-72 lg:h-80 object-cover rounded-3xl shadow-2xl shadow-[#D94368]/15">
                </div>
            </div>
        </div>
    </section>

    {{-- ── PRODUCTS GRID ───────────────────────────────────────── --}}
    <section aria-labelledby="skincare-products-heading" class="py-20 lg:py-28 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-12">
                <div>
                    <h2 id="skincare-products-heading" class="font-serif text-3xl sm:text-4xl font-medium text-[#2B2023]">All Skincare Products</h2>
                    <p class="text-[#76666B] text-base mt-1">6 products</p>
                </div>
                <select id="sort-skincare" aria-label="Sort products"
                        class="border border-[#F6ECE8] rounded-lg px-4 py-2 text-base text-[#76666B] focus:outline-none focus:ring-2 focus:ring-[#D94368]/30 bg-white">
                    <option>Sort: Featured</option>
                    <option>Price: Low to High</option>
                    <option>Price: High to Low</option>
                    <option>Best Sellers</option>
                </select>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-7">
                @foreach([
                    ['shaya_serum','Daily Glow Serum','Vitamin C + Hyaluronic Acid brightening formula for radiant, even skin tone.','$42.00','NEW','128'],
                    ['hydra_cream','Hydra Moisture Cream','Deep hydration with Ceramide & Peptide complex. 24-hour moisture lock.','$36.00','BEST SELLER','96'],
                    ['skincare_products','Glow Ritual Set','Complete 5-step routine — cleanser, toner, serum, moisturiser & SPF.','$89.00','SAVE 20%','74'],
                    ['shaya_serum','Brightening Toner','Rose water & Niacinamide formula to balance and prep skin.','$24.00','','42'],
                    ['hydra_cream','Overnight Repair Mask','Peptide-rich sleep mask that works while you rest.','$38.00','NEW','18'],
                    ['skincare_products','SPF 50 Daily Sunscreen','Lightweight broad-spectrum SPF. Invisible finish, no white cast.','$28.00','BEST SELLER','110'],
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

    {{-- ── WHY SHAYA SKINCARE ───────────────────────────────────── --}}
    <section aria-labelledby="why-skincare" class="py-20 bg-[#FFF9F7]">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 id="why-skincare" class="font-serif text-3xl sm:text-4xl font-medium text-[#2B2023] text-center mb-12">Why Shaya Skin?</h2>
            <div class="grid sm:grid-cols-3 gap-8 text-center">
                @foreach([
                    ['🌿','Clean Formulas','No parabens, sulphates, or synthetic fragrances. Just skin-loving ingredients.'],
                    ['🧬','Science-Backed','Every formula is dermatologist-tested and clinically proven to work.'],
                    ['♻️','Sustainable','Eco-conscious packaging and responsible sourcing, always.'],
                ] as [$icon,$title,$text])
                <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-md transition-shadow duration-200">
                    <span class="text-4xl block mb-4">{{ $icon }}</span>
                    <h3 class="font-serif text-xl font-medium text-[#2B2023] mb-3">{{ $title }}</h3>
                    <p class="text-[#76666B] text-base leading-relaxed">{{ $text }}</p>
                </div>
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

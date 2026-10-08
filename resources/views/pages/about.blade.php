@extends('layouts.app')

@section('title', 'About Us')
@section('meta_description', 'Learn about Shaya Skin\'s story. Discover our commitment to clean beauty, cruelty-free practices, and skincare that makes you feel like yourself.')

@section('content')

    {{-- ── ABOUT HERO ────────────────────────────────────────────── --}}
    <section class="bg-[#F9ECE8] py-20 lg:py-32" aria-labelledby="about-hero-heading">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 id="about-hero-heading" class="font-serif text-5xl sm:text-6xl font-medium tracking-tight leading-[1.05] text-[#2B2023] mb-6">
                Redefining <em class="text-[#D94368] not-italic font-normal">Natural Beauty.</em>
            </h1>
            <p class="text-[#76666B] text-xl leading-relaxed max-w-2xl mx-auto">
                At Shaya Skin, we believe that the best foundation you can wear is healthy, glowing skin. Our mission is to simplify your routine with effective, clean essentials.
            </p>
        </div>
    </section>

    {{-- ── OUR STORY ─────────────────────────────────────────────── --}}
    <section class="py-20 lg:py-28 bg-white" aria-label="Our Story">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="relative">
                    <img src="{{ asset('images/products/hero_model.jpg') }}" alt="Shaya Skin founder applying skincare"
                         class="w-full h-[500px] object-cover rounded-3xl shadow-xl shadow-[#D94368]/10">
                    <div class="absolute -bottom-8 -right-8 bg-[#D94368] text-white p-8 rounded-2xl shadow-lg hidden md:block">
                        <p class="font-serif text-4xl font-medium mb-1">5k+</p>
                        <p class="text-sm uppercase tracking-widest font-semibold">Happy Customers</p>
                    </div>
                </div>
                <div>
                    <p class="flex items-center gap-2.5 text-[#D94368] text-[10px] font-semibold tracking-[0.2em] uppercase mb-4">
                        <span class="block w-5 h-px bg-[#D94368]"></span> OUR STORY
                    </p>
                    <h2 class="font-serif text-4xl font-medium tracking-tight text-[#2B2023] mb-6">
                        Good skin isn't a look.<br>It's feeling like yourself.
                    </h2>
                    <div class="space-y-5 text-[#76666B] text-lg leading-relaxed">
                        <p>
                            It started with a simple question: Why is finding the right skincare so complicated? We saw aisles filled with confusing claims, harsh ingredients, and unattainable beauty standards. We wanted something different.
                        </p>
                        <p>
                            Shaya Skin was born from the desire to create a thoughtful line of essentials. Products that don't promise to "fix" your flaws, but rather nourish and protect the skin you're in. We spent two years working with leading dermatologists to formulate our core collection.
                        </p>
                        <p>
                            Every product we make is tested rigorously, but never on animals. We use potent natural extracts combined with safe, proven clinical ingredients. The result? Skincare and makeup that feels like a deep breath for your skin.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── OUR PROMISE ───────────────────────────────────────────── --}}
    <section class="py-20 lg:py-28 bg-[#2B2023] text-white" aria-label="Our Promise">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="font-serif text-4xl sm:text-5xl font-medium tracking-tight mb-4">Our Promise to You</h2>
                <div class="w-12 h-0.5 bg-[#D94368] mx-auto"></div>
            </div>

            <div class="grid md:grid-cols-3 gap-12">
                @foreach([
                    ['clean.svg', 'Clean Ingredients', 'We ban over 2,000 potentially harmful ingredients. If it\'s questionable, it doesn\'t go in our formulas. Your health is our priority.'],
                    ['cruelty-free.svg', 'Cruelty-Free', 'We love animals. Our products and ingredients are never tested on animals, and we only work with suppliers who share this commitment.'],
                    ['inclusive.svg', 'Inclusive Beauty', 'We formulate for all skin types, tones, and ages. Beauty isn\'t one-size-fits-all, and our product range reflects the diversity of real people.'],
                ] as [$icon, $title, $desc])
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-6 bg-[#D94368]/20 rounded-full flex items-center justify-center text-[#D94368] text-2xl">
                        {{-- Placeholder for actual SVG icons --}}
                        <span class="block w-8 h-8 bg-[#D94368] rounded-full"></span>
                    </div>
                    <h3 class="font-serif text-2xl font-medium mb-4">{{ $title }}</h3>
                    <p class="text-white/65 text-base leading-relaxed">{{ $desc }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection

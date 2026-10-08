@extends('layouts.app')

@section('title', 'Select Skin Type')

@section('content')
<section class="py-20 bg-[#FFF9F7]">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h1 class="font-serif text-4xl sm:text-5xl font-medium text-[#2B2023] mb-4">Choose your skin type</h1>
        <p class="text-[#76666B] text-lg mb-12">Find products carefully selected for your skin.</p>

        <div class="grid sm:grid-cols-3 gap-6">
            <a href="{{ route('shop', ['category' => $category, 'skin_type' => 'oily']) }}" class="group block bg-white rounded-3xl p-8 border border-[#F6ECE8] hover:border-[#D94368] hover:shadow-xl transition-all duration-300">
                <div class="w-20 h-20 mx-auto bg-[#F9ECE8] rounded-full flex items-center justify-center mb-6 group-hover:bg-[#D94368] transition-colors">
                    <span class="text-[#D94368] group-hover:text-white font-serif text-2xl font-bold">O</span>
                </div>
                <h2 class="text-xl font-bold text-[#2B2023] mb-2 uppercase tracking-wide">Oily</h2>
                <p class="text-[#76666B] text-sm">Prone to shine and breakouts. Needs oil control and lightweight hydration.</p>
            </a>

            <a href="{{ route('shop', ['category' => $category, 'skin_type' => 'combination']) }}" class="group block bg-white rounded-3xl p-8 border border-[#F6ECE8] hover:border-[#D94368] hover:shadow-xl transition-all duration-300">
                <div class="w-20 h-20 mx-auto bg-[#F9ECE8] rounded-full flex items-center justify-center mb-6 group-hover:bg-[#D94368] transition-colors">
                    <span class="text-[#D94368] group-hover:text-white font-serif text-2xl font-bold">C</span>
                </div>
                <h2 class="text-xl font-bold text-[#2B2023] mb-2 uppercase tracking-wide">Combination</h2>
                <p class="text-[#76666B] text-sm">Oily T-zone, normal to dry cheeks. Needs balance and gentle care.</p>
            </a>

            <a href="{{ route('shop', ['category' => $category, 'skin_type' => 'dry']) }}" class="group block bg-white rounded-3xl p-8 border border-[#F6ECE8] hover:border-[#D94368] hover:shadow-xl transition-all duration-300">
                <div class="w-20 h-20 mx-auto bg-[#F9ECE8] rounded-full flex items-center justify-center mb-6 group-hover:bg-[#D94368] transition-colors">
                    <span class="text-[#D94368] group-hover:text-white font-serif text-2xl font-bold">D</span>
                </div>
                <h2 class="text-xl font-bold text-[#2B2023] mb-2 uppercase tracking-wide">Dry</h2>
                <p class="text-[#76666B] text-sm">Often feels tight or flaky. Needs deep hydration and barrier repair.</p>
            </a>
        </div>
    </div>
</section>
@endsection

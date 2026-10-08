<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('meta_description', 'Shaya Skin — Premium skincare and makeup for every skin type. Clean, cruelty-free, dermatologist tested.')">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>@yield('title', 'Shaya Skin') — Feel Good in Your Skin</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="bg-rose-50 text-stone-800 antialiased min-w-[320px]">

    {{-- Announcement Bar --}}
    <div class="bg-pink-100 text-stone-700 text-[11px] font-medium text-center py-2 px-4">
        🌸 Free Shipping on orders over $50
        <span class="mx-3 text-pink-300">|</span>
        ✨ First order 10% off — code: <strong>GLOW10</strong>
        <span class="mx-3 text-pink-300">|</span>
        🌿 Clean &amp; Cruelty-Free
    </div>

    <header class="sticky top-0 z-50 bg-[#F9ECE8]/95 backdrop-blur-md border-b border-[#F6ECE8] shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20 gap-6">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 shrink-0" aria-label="Shaya Skin home">
                    <span class="font-serif text-2xl tracking-tight leading-none text-[#2B2023] font-bold">
                        Shaya <span class="text-[#D94368] font-light">Skin</span>
                    </span>
                </a>

                {{-- Desktop Nav --}}
                <nav class="hidden md:flex items-center gap-8" aria-label="Main navigation">
                    <a href="{{ route('home') }}" class="text-[#76666B] hover:text-[#D94368] font-medium transition-colors">Home</a>
                    <a href="{{ route('skin-type', ['category' => 'makeup']) }}" class="text-[#76666B] hover:text-[#D94368] font-medium transition-colors">Makeup</a>
                    <a href="{{ route('skin-type', ['category' => 'skincare']) }}" class="text-[#76666B] hover:text-[#D94368] font-medium transition-colors">Skincare</a>
                    <a href="{{ route('about') }}" class="text-[#76666B] hover:text-[#D94368] font-medium transition-colors">About Us</a>
                    <a href="{{ route('contact') }}" class="text-[#76666B] hover:text-[#D94368] font-medium transition-colors">Contact Us</a>
                </nav>

                {{-- Right Icons --}}
                <div class="flex items-center gap-2 sm:gap-3">
                    <form action="{{ route('shop') }}" method="GET" class="hidden md:block relative">
                        <input type="text" name="q" placeholder="Search..." class="bg-white border border-gray-200 rounded-full px-4 py-2 pr-9 text-sm focus:outline-none focus:border-[#D94368] text-[#2B2023] w-36">
                        <button type="submit" aria-label="Search" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#D94368]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>
                    </form>

                    @auth
                        @if (! auth()->user()->is_admin)
                            <span class="hidden max-w-28 truncate text-sm font-medium text-[#76666B] lg:inline">{{ auth()->user()->name }}</span>
                            <form action="{{ route('logout') }}" method="POST" class="hidden md:block">
                                @csrf
                                <button class="whitespace-nowrap rounded-full border border-[#F6ECE8] px-4 py-2 text-sm font-semibold text-[#76666B] transition hover:border-[#D94368] hover:text-[#D94368]">Log out</button>
                            </form>
                        @else
                            <div class="hidden items-center gap-1.5 md:flex">
                                <a href="{{ route('register') }}" class="whitespace-nowrap rounded-full border border-[#D94368] px-3 py-2 text-sm font-semibold text-[#D94368] transition hover:bg-[#D94368] hover:text-white">Register</a>
                                <a href="{{ route('login') }}" class="whitespace-nowrap rounded-full bg-[#D94368] px-3 py-2 text-sm font-semibold text-white transition hover:bg-[#B83253]">Login</a>
                            </div>
                        @endif
                    @else
                        <div class="hidden items-center gap-1.5 md:flex">
                            <a href="{{ route('register') }}" class="whitespace-nowrap rounded-full border border-[#D94368] px-3 py-2 text-sm font-semibold text-[#D94368] transition hover:bg-[#D94368] hover:text-white">Register</a>
                            <a href="{{ route('login') }}" class="whitespace-nowrap rounded-full bg-[#D94368] px-3 py-2 text-sm font-semibold text-white transition hover:bg-[#B83253]">Login</a>
                        </div>
                    @endauth

                    <a href="{{ route('cart') }}" class="relative text-[#2B2023] hover:text-[#D94368] transition-colors" aria-label="Cart">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        <span id="cart-count" class="absolute -top-2 -right-2 bg-[#D94368] text-white text-[10px] font-bold w-4 h-4 flex items-center justify-center rounded-full">0</span>
                    </a>

                    {{-- Mobile Hamburger --}}
                    <button id="mobile-menu-btn" aria-expanded="false" aria-controls="mobile-menu" aria-label="Toggle navigation"
                            class="md:hidden flex flex-col justify-between w-6 h-[18px] p-0 shrink-0">
                        <span class="block h-0.5 bg-[#2B2023] rounded transition-all duration-300 origin-center" id="bar1"></span>
                        <span class="block h-0.5 bg-[#2B2023] rounded transition-all duration-300" id="bar2"></span>
                        <span class="block h-0.5 bg-[#2B2023] rounded transition-all duration-300 origin-center" id="bar3"></span>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="md:hidden hidden border-t border-[#F6ECE8] bg-[#FFF9F7]">
            <nav class="flex flex-col px-6 py-4 gap-2" aria-label="Mobile navigation">
                <form action="{{ route('shop') }}" method="GET" class="mb-4 relative">
                    <input type="text" name="q" placeholder="Search..." class="w-full bg-white border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-[#D94368] text-[#2B2023]">
                </form>
                <a href="{{ route('home') }}" class="text-[#76666B] py-2 font-medium">Home</a>
                <a href="{{ route('skin-type', ['category' => 'makeup']) }}" class="text-[#76666B] py-2 font-medium">Makeup</a>
                <a href="{{ route('skin-type', ['category' => 'skincare']) }}" class="text-[#76666B] py-2 font-medium">Skincare</a>
                <a href="{{ route('about') }}" class="text-[#76666B] py-2 font-medium">About Us</a>
                <a href="{{ route('contact') }}" class="text-[#76666B] py-2 font-medium">Contact Us</a>
                @auth
                    @if (! auth()->user()->is_admin)
                        <form action="{{ route('logout') }}" method="POST" class="py-2">
                            @csrf
                            <button class="font-semibold text-[#D94368]">Log out</button>
                        </form>
                    @else
                        <div class="flex gap-3 border-t border-[#F6ECE8] pt-3">
                            <a href="{{ route('register') }}" class="flex-1 rounded-lg border border-[#D94368] px-4 py-2 text-center font-semibold text-[#D94368]">Register</a>
                            <a href="{{ route('login') }}" class="flex-1 rounded-lg bg-[#D94368] px-4 py-2 text-center font-semibold text-white">Login</a>
                        </div>
                    @endif
                @else
                    <div class="flex gap-3 border-t border-[#F6ECE8] pt-3">
                        <a href="{{ route('register') }}" class="flex-1 rounded-lg border border-[#D94368] px-4 py-2 text-center font-semibold text-[#D94368]">Register</a>
                        <a href="{{ route('login') }}" class="flex-1 rounded-lg bg-[#D94368] px-4 py-2 text-center font-semibold text-white">Login</a>
                    </div>
                @endauth
            </nav>
        </div>
    </header>

    {{-- Page Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-[#2B2023] text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">

                {{-- Brand --}}
                <div class="lg:col-span-1">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 mb-4">
                        <span class="font-serif text-2xl tracking-tight leading-none text-white font-bold">
                            Shaya <span class="text-[#D94368] font-light">Skin</span>
                        </span>
                    </a>
                    <p class="text-gray-400 text-base leading-relaxed mb-6">Beauty that understands your skin.</p>
                    <div class="flex gap-3">
                        <a href="#" aria-label="Instagram" class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#D94368] flex items-center justify-center transition-colors duration-200">
                            <svg class="w-4 h-4 fill-white" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="#" aria-label="Facebook" class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#D94368] flex items-center justify-center transition-colors duration-200">
                            <svg class="w-4 h-4 fill-white" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" aria-label="TikTok" class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#D94368] flex items-center justify-center transition-colors duration-200">
                            <svg class="w-4 h-4 fill-white" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                        </a>
                    </div>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-widest text-gray-400 mb-5">Quick Links</h4>
                    <ul class="flex flex-col gap-3">
                        <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-[#D94368] text-base transition-colors duration-150">Home</a></li>
                        <li><a href="{{ route('skin-type', ['category' => 'skincare']) }}" class="text-gray-300 hover:text-[#D94368] text-base transition-colors duration-150">Skincare</a></li>
                        <li><a href="{{ route('skin-type', ['category' => 'makeup']) }}" class="text-gray-300 hover:text-[#D94368] text-base transition-colors duration-150">Makeup</a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-[#D94368] text-base transition-colors duration-150">About Us</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-[#D94368] text-base transition-colors duration-150">Contact Us</a></li>
                    </ul>
                </div>

                {{-- Help --}}
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-widest text-gray-400 mb-5">Help</h4>
                    <ul class="flex flex-col gap-3">
                        <li><a href="#" class="text-gray-300 hover:text-[#D94368] text-base transition-colors duration-150">Shipping & Returns</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-[#D94368] text-base transition-colors duration-150">FAQ</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-[#D94368] text-base transition-colors duration-150">Track Order</a></li>
                    </ul>
                </div>

                {{-- Payment Methods --}}
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-widest text-gray-400 mb-5">Payment Methods</h4>
                    <div class="flex flex-wrap gap-2">
                        <span class="bg-white/10 text-white text-xs font-semibold px-3 py-1.5 rounded">Cash on Delivery</span>
                        <span class="bg-white/10 text-white text-xs font-semibold px-3 py-1.5 rounded">eSewa</span>
                        <span class="bg-white/10 text-white text-xs font-semibold px-3 py-1.5 rounded">Khalti</span>
                        <span class="bg-white/10 text-white text-xs font-semibold px-3 py-1.5 rounded">Bank Transfer</span>
                    </div>
                </div>

            </div>
        </div>

        <div class="border-t border-white/10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 flex flex-col sm:flex-row items-center justify-between gap-3">
                <p class="text-gray-500 text-sm">© {{ date('Y') }} Shaya Skin. All rights reserved.</p>
                <div class="flex gap-5">
                    <a href="#" class="text-gray-500 hover:text-[#D94368] text-sm transition-colors duration-150">Privacy Policy</a>
                    <a href="#" class="text-gray-500 hover:text-[#D94368] text-sm transition-colors duration-150">Terms & Conditions</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        const b1 = document.getElementById('bar1');
        const b2 = document.getElementById('bar2');
        const b3 = document.getElementById('bar3');

        btn.addEventListener('click', () => {
            const open = menu.classList.toggle('hidden');
            btn.setAttribute('aria-expanded', !open);
            if (!open) {
                b1.style.cssText = 'transform: translateY(8px) rotate(45deg)';
                b2.style.cssText = 'opacity: 0; transform: scaleX(0)';
                b3.style.cssText = 'transform: translateY(-8px) rotate(-45deg)';
            } else {
                b1.style.cssText = b2.style.cssText = b3.style.cssText = '';
            }
        });

        // Newsletter form
        const nf = document.getElementById('newsletter-form');
        if (nf) {
            nf.addEventListener('submit', e => {
                e.preventDefault();
                const sb = document.getElementById('newsletter-submit');
                sb.textContent = '✓ Joined!';
                sb.classList.replace('bg-rose-500', 'bg-green-500');
                sb.classList.replace('hover:bg-rose-600', 'hover:bg-green-600');
                setTimeout(() => { sb.textContent = 'Join →'; sb.classList.replace('bg-green-500','bg-rose-500'); sb.classList.replace('hover:bg-green-600','hover:bg-rose-600'); nf.reset(); }, 3000);
            });
        }
    </script>
    @stack('scripts')
</body>
</html>

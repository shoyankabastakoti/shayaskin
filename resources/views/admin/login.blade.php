@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
<section class="flex min-h-[70vh] items-center justify-center bg-[#FFF9F7] px-4 py-16">
    <div class="w-full max-w-md rounded-3xl border border-[#F6ECE8] bg-white p-8 shadow-xl shadow-[#D94368]/5 sm:p-10">
        <p class="mb-3 text-xs font-bold uppercase tracking-[0.2em] text-[#D94368]">Shaya Skin</p>
        <h1 class="mb-2 font-sans text-4xl font-semibold text-[#2B2023]">Admin sign in</h1>
        <p class="mb-8 text-sm text-[#76666B]">Sign in to manage the product catalog.</p>

        <form action="{{ route('admin.login.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label for="email" class="mb-2 block text-sm font-semibold text-[#2B2023]">Email address</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    autocomplete="username"
                    required
                    autofocus
                    class="w-full rounded-xl border border-[#F6ECE8] px-4 py-3 text-[#2B2023] outline-none transition focus:border-[#D94368] focus:ring-2 focus:ring-[#D94368]/20"
                >
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="mb-2 block text-sm font-semibold text-[#2B2023]">Password</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    autocomplete="current-password"
                    required
                    class="w-full rounded-xl border border-[#F6ECE8] px-4 py-3 text-[#2B2023] outline-none transition focus:border-[#D94368] focus:ring-2 focus:ring-[#D94368]/20"
                >
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <label class="flex items-center gap-2 text-sm text-[#76666B]">
                <input type="checkbox" name="remember" value="1" class="rounded border-[#F6ECE8] text-[#D94368] focus:ring-[#D94368]">
                Remember me
            </label>

            <button type="submit" class="w-full rounded-xl bg-[#D94368] px-5 py-3.5 font-semibold text-white transition hover:bg-[#B83253]">
                Sign in
            </button>
        </form>
    </div>
</section>
@endsection

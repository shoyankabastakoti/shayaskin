@extends('layouts.app')

@section('title', 'Register')

@section('content')
<section class="flex min-h-[70vh] items-center justify-center bg-[#FFF9F7] px-4 py-12">
    <div class="w-full max-w-md rounded-3xl border border-[#F6ECE8] bg-white p-8 shadow-sm sm:p-10">
        <p class="mb-3 text-xs font-bold uppercase tracking-[0.2em] text-[#D94368]">Join Shaya Skin</p>
        <h1 class="font-serif text-4xl font-semibold text-[#2B2023]">Create an account</h1>
        <p class="mt-2 text-sm text-[#76666B]">Register to get started with your customer account.</p>

        <form action="{{ route('register.store') }}" method="POST" class="mt-8 grid gap-5">
            @csrf
            <div>
                <label for="name" class="mb-2 block text-sm font-semibold text-[#2B2023]">Full name</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" required class="w-full rounded-xl border border-[#F6ECE8] px-4 py-3 text-[#2B2023] outline-none transition focus:border-[#D94368] focus:ring-2 focus:ring-[#D94368]/20">
                @error('name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="email" class="mb-2 block text-sm font-semibold text-[#2B2023]">Email address</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required class="w-full rounded-xl border border-[#F6ECE8] px-4 py-3 text-[#2B2023] outline-none transition focus:border-[#D94368] focus:ring-2 focus:ring-[#D94368]/20">
                @error('email') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="password" class="mb-2 block text-sm font-semibold text-[#2B2023]">Password</label>
                <input id="password" name="password" type="password" autocomplete="new-password" minlength="12" required class="w-full rounded-xl border border-[#F6ECE8] px-4 py-3 text-[#2B2023] outline-none transition focus:border-[#D94368] focus:ring-2 focus:ring-[#D94368]/20">
                @error('password') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="password_confirmation" class="mb-2 block text-sm font-semibold text-[#2B2023]">Confirm password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" minlength="12" required class="w-full rounded-xl border border-[#F6ECE8] px-4 py-3 text-[#2B2023] outline-none transition focus:border-[#D94368] focus:ring-2 focus:ring-[#D94368]/20">
            </div>
            <button class="w-full rounded-xl bg-[#D94368] px-5 py-3.5 font-semibold text-white transition hover:bg-[#B83253]">Create account</button>
        </form>

        <p class="mt-6 text-center text-sm text-[#76666B]">
            Already have an account?
            <a href="{{ route('login') }}" class="font-semibold text-[#D94368] hover:text-[#B83253]">Login</a>
        </p>
    </div>
</section>
@endsection

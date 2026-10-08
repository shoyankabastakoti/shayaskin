@extends('layouts.admin')

@section('title', 'Create Admin')

@section('content')
<div class="mb-8">
    <p class="mb-2 text-xs font-bold uppercase tracking-[0.2em] text-[#D94368]">Team access</p>
    <h1 class="font-serif text-4xl font-semibold">Create an admin</h1>
    <p class="mt-2 text-sm text-[#76666B]">Add another trusted administrator to help manage the store.</p>
</div>

<section class="max-w-2xl rounded-2xl border border-[#F6ECE8] bg-white p-6 shadow-sm sm:p-8">
    <div class="mb-6">
        <h2 class="font-serif text-2xl font-semibold">Admin account details</h2>
        <p class="mt-2 text-sm leading-6 text-[#76666B]">New administrators can manage products, orders, customers, sales, purchases, and settings.</p>
    </div>

    <form action="{{ route('admin.settings.admins.store') }}" method="POST" class="grid gap-5">
        @csrf
        <div>
            <label for="name" class="mb-2 block text-sm font-semibold">Full name</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" required class="w-full rounded-xl border border-[#F6ECE8] px-4 py-3 outline-none focus:border-[#D94368]">
            @error('name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="email" class="mb-2 block text-sm font-semibold">Email address</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required class="w-full rounded-xl border border-[#F6ECE8] px-4 py-3 outline-none focus:border-[#D94368]">
            @error('email') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="password" class="mb-2 block text-sm font-semibold">Temporary password</label>
            <input id="password" name="password" type="password" autocomplete="new-password" minlength="12" required class="w-full rounded-xl border border-[#F6ECE8] px-4 py-3 outline-none focus:border-[#D94368]">
            @error('password') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="password_confirmation" class="mb-2 block text-sm font-semibold">Confirm temporary password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" minlength="12" required class="w-full rounded-xl border border-[#F6ECE8] px-4 py-3 outline-none focus:border-[#D94368]">
        </div>
        <button class="w-fit rounded-xl bg-[#2B2023] px-5 py-3 font-semibold text-white transition hover:bg-[#D94368]">Create admin account</button>
    </form>
</section>
@endsection

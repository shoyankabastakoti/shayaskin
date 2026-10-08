@extends('layouts.admin')

@section('title', 'Change Password')

@section('content')
<div class="mb-8">
    <p class="mb-2 text-xs font-bold uppercase tracking-[0.2em] text-[#D94368]">Account security</p>
    <h1 class="font-serif text-4xl font-semibold">Change password</h1>
    <p class="mt-2 text-sm text-[#76666B]">Update the password for your administrator account.</p>
</div>

<section class="max-w-2xl rounded-2xl border border-[#F6ECE8] bg-white p-6 shadow-sm sm:p-8">
    <div class="mb-6">
        <h2 class="font-serif text-2xl font-semibold">Password settings</h2>
        <p class="mt-2 text-sm leading-6 text-[#76666B]">Confirm your current password, then choose a new password with at least 12 characters.</p>
    </div>

    <form action="{{ route('admin.settings.password.update') }}" method="POST" class="grid gap-5">
        @csrf
        @method('PATCH')
        <div>
            <label for="current_password" class="mb-2 block text-sm font-semibold">Current password</label>
            <input id="current_password" name="current_password" type="password" autocomplete="current-password" required class="w-full rounded-xl border border-[#F6ECE8] px-4 py-3 outline-none focus:border-[#D94368]">
            @error('current_password') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="password" class="mb-2 block text-sm font-semibold">New password</label>
            <input id="password" name="password" type="password" autocomplete="new-password" minlength="12" required class="w-full rounded-xl border border-[#F6ECE8] px-4 py-3 outline-none focus:border-[#D94368]">
            @error('password') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="password_confirmation" class="mb-2 block text-sm font-semibold">Confirm new password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" minlength="12" required class="w-full rounded-xl border border-[#F6ECE8] px-4 py-3 outline-none focus:border-[#D94368]">
        </div>
        <button class="w-fit rounded-xl bg-[#D94368] px-5 py-3 font-semibold text-white transition hover:bg-[#B83253]">Save new password</button>
    </form>
</section>
@endsection

@extends('layouts.admin')

@section('title', $product->exists ? 'Edit Product' : 'Add Product')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.products.index') }}" class="mb-4 inline-block text-sm font-semibold text-[#D94368] hover:text-[#B83253]">&larr; Back to products</a>
    <h1 class="font-serif text-4xl font-semibold">{{ $product->exists ? 'Edit product' : 'Add product' }}</h1>
</div>

<form
    action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}"
    method="POST"
    enctype="multipart/form-data"
    class="space-y-8 rounded-3xl border border-[#F6ECE8] bg-white p-6 shadow-sm sm:p-8"
>
    @csrf
    @if ($product->exists)
        @method('PUT')
    @endif

    <div class="grid gap-6 sm:grid-cols-2">
        <div>
            <label for="name" class="mb-2 block text-sm font-semibold">Product name</label>
            <input id="name" name="name" value="{{ old('name', $product->name) }}" required class="w-full rounded-xl border border-[#F6ECE8] px-4 py-3 outline-none focus:border-[#D94368]">
            @error('name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="brand" class="mb-2 block text-sm font-semibold">Brand</label>
            <input id="brand" name="brand" value="{{ old('brand', $product->brand) }}" required class="w-full rounded-xl border border-[#F6ECE8] px-4 py-3 outline-none focus:border-[#D94368]">
            @error('brand') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="price" class="mb-2 block text-sm font-semibold">Price (Rs.)</label>
            <input id="price" name="price" type="number" min="0" step="1" value="{{ old('price', $product->price) }}" required class="w-full rounded-xl border border-[#F6ECE8] px-4 py-3 outline-none focus:border-[#D94368]">
            @error('price') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="stock_quantity" class="mb-2 block text-sm font-semibold">Stock quantity</label>
            <input id="stock_quantity" name="stock_quantity" type="number" min="0" step="1" value="{{ old('stock_quantity', $product->stock_quantity ?? 0) }}" class="w-full rounded-xl border border-[#F6ECE8] px-4 py-3 outline-none focus:border-[#D94368]">
            @error('stock_quantity') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            <p class="mt-1 text-xs text-[#76666B]">Supplier purchases add to this quantity.</p>
        </div>
        <div>
            <label for="category" class="mb-2 block text-sm font-semibold">Category</label>
            <select id="category" name="category" required class="w-full rounded-xl border border-[#F6ECE8] bg-white px-4 py-3 outline-none focus:border-[#D94368]">
                @foreach (['skincare' => 'Skincare', 'makeup' => 'Makeup'] as $value => $label)
                    <option value="{{ $value }}" @selected(old('category', $product->category) === $value)>{{ $label }}</option>
                @endforeach
            </select>
            @error('category') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="skin_type" class="mb-2 block text-sm font-semibold">Skin type</label>
            <select id="skin_type" name="skin_type" required class="w-full rounded-xl border border-[#F6ECE8] bg-white px-4 py-3 outline-none focus:border-[#D94368]">
                @foreach (['oily' => 'Oily', 'dry' => 'Dry', 'combination' => 'Combination', 'all' => 'All skin types'] as $value => $label)
                    <option value="{{ $value }}" @selected(old('skin_type', $product->skin_type) === $value)>{{ $label }}</option>
                @endforeach
            </select>
            @error('skin_type') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="image" class="mb-2 block text-sm font-semibold">Product image {{ $product->exists ? '(optional)' : '' }}</label>
            <input id="image" name="image" type="file" accept="image/jpeg,image/png,image/webp" @required(! $product->exists) class="w-full rounded-xl border border-[#F6ECE8] bg-white px-4 py-3 file:mr-4 file:rounded-lg file:border-0 file:bg-[#F9ECE8] file:px-3 file:py-2 file:font-semibold file:text-[#D94368]">
            @error('image') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            @if ($product->exists)
                <img src="{{ $product->image }}" alt="Current product image" class="mt-3 h-28 w-24 rounded-lg bg-[#F9ECE8] object-cover">
            @endif
        </div>
        <div>
            <label for="rating" class="mb-2 block text-sm font-semibold">Rating (0–5)</label>
            <input id="rating" name="rating" type="number" min="0" max="5" step="0.1" value="{{ old('rating', $product->rating ?? 0) }}" class="w-full rounded-xl border border-[#F6ECE8] px-4 py-3 outline-none focus:border-[#D94368]">
            @error('rating') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="reviews" class="mb-2 block text-sm font-semibold">Review count</label>
            <input id="reviews" name="reviews" type="number" min="0" step="1" value="{{ old('reviews', $product->reviews ?? 0) }}" class="w-full rounded-xl border border-[#F6ECE8] px-4 py-3 outline-none focus:border-[#D94368]">
            @error('reviews') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
    </div>

    <div>
        <label for="description" class="mb-2 block text-sm font-semibold">Description</label>
        <textarea id="description" name="description" rows="3" required class="w-full rounded-xl border border-[#F6ECE8] px-4 py-3 outline-none focus:border-[#D94368]">{{ old('description', $product->description) }}</textarea>
        @error('description') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="ingredients" class="mb-2 block text-sm font-semibold">Ingredients</label>
        <textarea id="ingredients" name="ingredients" rows="2" class="w-full rounded-xl border border-[#F6ECE8] px-4 py-3 outline-none focus:border-[#D94368]">{{ old('ingredients', $product->ingredients) }}</textarea>
        @error('ingredients') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="benefits" class="mb-2 block text-sm font-semibold">Benefits</label>
        <textarea id="benefits" name="benefits" rows="2" class="w-full rounded-xl border border-[#F6ECE8] px-4 py-3 outline-none focus:border-[#D94368]">{{ old('benefits', $product->benefits) }}</textarea>
        @error('benefits') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="how_to_use" class="mb-2 block text-sm font-semibold">How to use</label>
        <textarea id="how_to_use" name="how_to_use" rows="2" class="w-full rounded-xl border border-[#F6ECE8] px-4 py-3 outline-none focus:border-[#D94368]">{{ old('how_to_use', $product->how_to_use) }}</textarea>
        @error('how_to_use') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="flex flex-col-reverse gap-3 border-t border-[#F6ECE8] pt-6 sm:flex-row sm:justify-end">
        <a href="{{ route('admin.products.index') }}" class="rounded-full border border-[#F6ECE8] px-6 py-3 text-center font-semibold text-[#76666B] hover:bg-[#FFF9F7]">Cancel</a>
        <button type="submit" class="rounded-full bg-[#D94368] px-7 py-3 font-semibold text-white hover:bg-[#B83253]">{{ $product->exists ? 'Save changes' : 'Create product' }}</button>
    </div>
</form>
@endsection

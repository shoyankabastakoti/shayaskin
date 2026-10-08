@extends('layouts.admin')

@section('title', 'Manage Products')

@section('content')
<div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
    <div>
        <p class="mb-2 text-xs font-bold uppercase tracking-[0.2em] text-[#D94368]">Catalog</p>
        <h1 class="font-serif text-4xl font-semibold">Products</h1>
        <p class="mt-2 text-sm text-[#76666B]">{{ $products->total() }} products in your store</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="inline-flex items-center justify-center rounded-full bg-[#D94368] px-6 py-3 font-semibold text-white transition hover:bg-[#B83253]">
        Add product
    </a>
</div>

<form action="{{ route('admin.products.index') }}" method="GET" class="mb-6 flex gap-3">
    <label for="product-search" class="sr-only">Search products</label>
    <input id="product-search" name="q" value="{{ $search }}" placeholder="Search name or brand" class="min-w-0 flex-1 rounded-xl border border-[#F6ECE8] bg-white px-4 py-3 outline-none focus:border-[#D94368]">
    <button class="rounded-xl border border-[#F6ECE8] bg-white px-5 py-3 font-semibold text-[#76666B] hover:border-[#D94368] hover:text-[#D94368]">Search</button>
</form>

<div class="overflow-hidden rounded-2xl border border-[#F6ECE8] bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full min-w-[720px] text-left">
            <thead class="bg-[#F9ECE8] text-xs uppercase tracking-wider text-[#76666B]">
                <tr>
                    <th class="px-5 py-4 font-semibold">Product</th>
                    <th class="px-5 py-4 font-semibold">Category</th>
                    <th class="px-5 py-4 font-semibold">Skin type</th>
                    <th class="px-5 py-4 font-semibold">Price</th>
                    <th class="px-5 py-4 font-semibold">Stock</th>
                    <th class="px-5 py-4 text-right font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#F6ECE8]">
                @forelse ($products as $product)
                    <tr>
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <img src="{{ $product->image }}" alt="" class="h-14 w-12 rounded-lg bg-[#F9ECE8] object-cover">
                                <div>
                                    <p class="font-semibold">{{ $product->name }}</p>
                                    <p class="text-sm text-[#76666B]">{{ $product->brand }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-4 text-sm capitalize text-[#76666B]">{{ $product->category }}</td>
                        <td class="px-5 py-4 text-sm capitalize text-[#76666B]">{{ $product->skin_type }}</td>
                        <td class="px-5 py-4 text-sm font-semibold">Rs. {{ number_format($product->price) }}</td>
                        <td class="px-5 py-4 text-sm font-semibold">{{ number_format($product->stock_quantity) }}</td>
                        <td class="px-5 py-4">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('admin.products.edit', $product) }}" class="text-sm font-semibold text-[#D94368] hover:text-[#B83253]">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-sm font-semibold text-red-600 hover:text-red-800">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-16 text-center text-[#76666B]">No products found. Add a product to get started.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">{{ $products->links() }}</div>
@endsection

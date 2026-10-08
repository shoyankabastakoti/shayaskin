@extends('layouts.admin')

@section('title', 'Record Purchase')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.purchases.index') }}" class="mb-4 inline-block text-sm font-semibold text-[#D94368] hover:text-[#B83253]">&larr; Back to purchases</a>
    <p class="mb-2 text-xs font-bold uppercase tracking-[0.2em] text-[#D94368]">Supplier inventory</p>
    <h1 class="font-serif text-4xl font-semibold">Record purchase</h1>
    <p class="mt-2 text-sm text-[#76666B]">Saving this purchase adds the received quantities to product stock.</p>
</div>

<form action="{{ route('admin.purchases.store') }}" method="POST" class="grid gap-6">
    @csrf
    @error('items')<p class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">{{ $message }}</p>@enderror

    <section class="grid gap-5 rounded-2xl border border-[#F6ECE8] bg-white p-6 shadow-sm sm:grid-cols-2">
        <div>
            <label for="supplier_name" class="mb-2 block text-sm font-semibold">Supplier name</label>
            <input id="supplier_name" name="supplier_name" value="{{ old('supplier_name') }}" required class="w-full rounded-xl border border-[#F6ECE8] px-4 py-3 outline-none focus:border-[#D94368]">
            @error('supplier_name')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="supplier_reference" class="mb-2 block text-sm font-semibold">Invoice/reference number <span class="font-normal text-[#76666B]">(optional)</span></label>
            <input id="supplier_reference" name="supplier_reference" value="{{ old('supplier_reference') }}" class="w-full rounded-xl border border-[#F6ECE8] px-4 py-3 outline-none focus:border-[#D94368]">
            @error('supplier_reference')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="supplier_email" class="mb-2 block text-sm font-semibold">Supplier email <span class="font-normal text-[#76666B]">(optional)</span></label>
            <input id="supplier_email" name="supplier_email" type="email" value="{{ old('supplier_email') }}" class="w-full rounded-xl border border-[#F6ECE8] px-4 py-3 outline-none focus:border-[#D94368]">
            @error('supplier_email')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="supplier_phone" class="mb-2 block text-sm font-semibold">Supplier phone <span class="font-normal text-[#76666B]">(optional)</span></label>
            <input id="supplier_phone" name="supplier_phone" value="{{ old('supplier_phone') }}" class="w-full rounded-xl border border-[#F6ECE8] px-4 py-3 outline-none focus:border-[#D94368]">
            @error('supplier_phone')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
        <div class="sm:col-span-2">
            <label for="notes" class="mb-2 block text-sm font-semibold">Notes <span class="font-normal text-[#76666B]">(optional)</span></label>
            <textarea id="notes" name="notes" rows="2" class="w-full rounded-xl border border-[#F6ECE8] px-4 py-3 outline-none focus:border-[#D94368]">{{ old('notes') }}</textarea>
            @error('notes')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
    </section>

    <section class="overflow-hidden rounded-2xl border border-[#F6ECE8] bg-white shadow-sm">
        <div class="flex flex-col justify-between gap-3 border-b border-[#F6ECE8] px-5 py-4 sm:flex-row sm:items-center sm:px-6">
            <div>
                <h2 class="font-serif text-2xl font-semibold">Purchased products</h2>
                <p class="mt-1 text-sm text-[#76666B]">Enter the unit cost and quantity received for each product.</p>
            </div>
            <button id="add-purchase-item" type="button" class="rounded-xl border border-[#F6ECE8] px-4 py-2 text-sm font-semibold text-[#D94368] hover:bg-[#FFF9F7]">Add product</button>
        </div>
        <div id="purchase-items" class="grid gap-4 p-5 sm:p-6">
            @php($oldItems = old('items', [['product_id' => '', 'quantity' => 1, 'unit_cost' => '']]))
            @foreach ($oldItems as $index => $oldItem)
                <div class="purchase-item grid gap-3 rounded-xl border border-[#F6ECE8] p-4 sm:grid-cols-[minmax(0,1fr)_8rem_10rem_auto] sm:items-end">
                    <div>
                        <label for="items-{{ $index }}-product" class="mb-2 block text-sm font-semibold">Product</label>
                        <select id="items-{{ $index }}-product" name="items[{{ $index }}][product_id]" required class="w-full rounded-xl border border-[#F6ECE8] bg-white px-3 py-3">
                            <option value="">Select product</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" @selected((string) ($oldItem['product_id'] ?? '') === (string) $product->id)>{{ $product->name }} — current stock {{ number_format($product->stock_quantity) }}</option>
                            @endforeach
                        </select>
                        @error("items.$index.product_id")<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="items-{{ $index }}-quantity" class="mb-2 block text-sm font-semibold">Quantity</label>
                        <input id="items-{{ $index }}-quantity" name="items[{{ $index }}][quantity]" type="number" min="1" max="65535" value="{{ $oldItem['quantity'] ?? 1 }}" required class="w-full rounded-xl border border-[#F6ECE8] px-3 py-3">
                        @error("items.$index.quantity")<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="items-{{ $index }}-unit-cost" class="mb-2 block text-sm font-semibold">Unit cost (Rs.)</label>
                        <input id="items-{{ $index }}-unit-cost" name="items[{{ $index }}][unit_cost]" type="number" min="1" step="1" value="{{ $oldItem['unit_cost'] ?? '' }}" required class="w-full rounded-xl border border-[#F6ECE8] px-3 py-3">
                        @error("items.$index.unit_cost")<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <button type="button" class="remove-purchase-item rounded-xl px-3 py-3 text-sm font-semibold text-red-600 hover:bg-red-50" aria-label="Remove product">Remove</button>
                </div>
            @endforeach
        </div>
        @if ($products->isEmpty())
            <p class="mx-5 mb-5 rounded-xl bg-amber-50 p-4 text-sm text-amber-800 sm:mx-6">Add products to your catalog before recording an inventory purchase.</p>
        @endif
    </section>

    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
        <a href="{{ route('admin.purchases.index') }}" class="rounded-full border border-[#F6ECE8] px-6 py-3 text-center font-semibold text-[#76666B] hover:bg-white">Cancel</a>
        <button @disabled($products->isEmpty()) class="rounded-full bg-[#D94368] px-7 py-3 font-semibold text-white transition hover:bg-[#B83253] disabled:cursor-not-allowed disabled:opacity-50">Record purchase and add stock</button>
    </div>
</form>

<template id="purchase-item-template">
    <div class="purchase-item grid gap-3 rounded-xl border border-[#F6ECE8] p-4 sm:grid-cols-[minmax(0,1fr)_8rem_10rem_auto] sm:items-end">
        <div>
            <label for="items-__INDEX__-product" class="mb-2 block text-sm font-semibold">Product</label>
            <select id="items-__INDEX__-product" name="items[__INDEX__][product_id]" required class="w-full rounded-xl border border-[#F6ECE8] bg-white px-3 py-3">
                <option value="">Select product</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }} — current stock {{ number_format($product->stock_quantity) }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="items-__INDEX__-quantity" class="mb-2 block text-sm font-semibold">Quantity</label>
            <input id="items-__INDEX__-quantity" name="items[__INDEX__][quantity]" type="number" min="1" max="65535" value="1" required class="w-full rounded-xl border border-[#F6ECE8] px-3 py-3">
        </div>
        <div>
            <label for="items-__INDEX__-unit-cost" class="mb-2 block text-sm font-semibold">Unit cost (Rs.)</label>
            <input id="items-__INDEX__-unit-cost" name="items[__INDEX__][unit_cost]" type="number" min="1" step="1" required class="w-full rounded-xl border border-[#F6ECE8] px-3 py-3">
        </div>
        <button type="button" class="remove-purchase-item rounded-xl px-3 py-3 text-sm font-semibold text-red-600 hover:bg-red-50" aria-label="Remove product">Remove</button>
    </div>
</template>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const items = document.getElementById('purchase-items');
        const template = document.getElementById('purchase-item-template');
        let nextIndex = items.querySelectorAll('.purchase-item').length;

        document.getElementById('add-purchase-item').addEventListener('click', () => {
            items.insertAdjacentHTML('beforeend', template.innerHTML.replaceAll('__INDEX__', String(nextIndex++)));
        });

        items.addEventListener('click', (event) => {
            if (event.target.closest('.remove-purchase-item') && items.querySelectorAll('.purchase-item').length > 1) {
                event.target.closest('.purchase-item').remove();
            }
        });
    });
</script>
@endsection

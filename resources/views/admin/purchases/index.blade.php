@extends('layouts.admin')

@section('title', 'Purchases')

@section('content')
<div class="mb-8 flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
    <div>
        <p class="mb-2 text-xs font-bold uppercase tracking-[0.2em] text-[#D94368]">Supplier inventory</p>
        <h1 class="font-serif text-4xl font-semibold">Purchases</h1>
        <p class="mt-2 text-sm text-[#76666B]">{{ number_format($purchases->total()) }} recorded supplier purchases.</p>
    </div>
    <a href="{{ route('admin.purchases.create') }}" class="inline-flex items-center justify-center rounded-full bg-[#D94368] px-6 py-3 font-semibold text-white transition hover:bg-[#B83253]">Record purchase</a>
</div>

<form action="{{ route('admin.purchases.index') }}" method="GET" class="mb-6 flex gap-3">
    <label for="purchase-search" class="sr-only">Search supplier purchases</label>
    <input id="purchase-search" name="q" value="{{ $search }}" placeholder="Search purchase number, supplier, or reference" class="min-w-0 flex-1 rounded-xl border border-[#F6ECE8] bg-white px-4 py-3 outline-none focus:border-[#D94368]">
    <button class="rounded-xl border border-[#F6ECE8] bg-white px-5 py-3 font-semibold text-[#76666B] hover:border-[#D94368] hover:text-[#D94368]">Search</button>
</form>

<div class="overflow-hidden rounded-2xl border border-[#F6ECE8] bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full min-w-[650px] text-left">
            <thead class="bg-[#F9ECE8] text-xs uppercase tracking-wider text-[#76666B]">
                <tr>
                    <th class="px-5 py-4 font-semibold">Purchase</th>
                    <th class="px-5 py-4 font-semibold">Supplier</th>
                    <th class="px-5 py-4 font-semibold">Date</th>
                    <th class="px-5 py-4 font-semibold">Items</th>
                    <th class="px-5 py-4 text-right font-semibold">Total cost</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#F6ECE8]">
                @forelse ($purchases as $purchase)
                    <tr>
                        <td class="px-5 py-4"><a href="{{ route('admin.purchases.show', $purchase) }}" class="font-semibold text-[#D94368] hover:text-[#B83253]">{{ $purchase->purchase_number }}</a></td>
                        <td class="px-5 py-4"><p class="font-medium">{{ $purchase->supplier_name }}</p>@if ($purchase->supplier_reference)<p class="text-xs text-[#76666B]">Ref: {{ $purchase->supplier_reference }}</p>@endif</td>
                        <td class="px-5 py-4 text-sm text-[#76666B]">{{ $purchase->created_at->format('M j, Y') }}</td>
                        <td class="px-5 py-4 text-sm text-[#76666B]">{{ number_format($purchase->items_count) }}</td>
                        <td class="px-5 py-4 text-right text-sm font-semibold">Rs. {{ number_format($purchase->total_amount) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-5 py-16 text-center text-[#76666B]">No supplier purchases yet. Record a purchase to add stock.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-6">{{ $purchases->links() }}</div>
@endsection

@extends('layouts.admin')

@section('title', 'Purchase '.$purchase->purchase_number)

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.purchases.index') }}" class="mb-4 inline-block text-sm font-semibold text-[#D94368] hover:text-[#B83253]">&larr; Back to purchases</a>
    <p class="mb-2 text-xs font-bold uppercase tracking-[0.2em] text-[#D94368]">Supplier purchase</p>
    <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-end">
        <div>
            <h1 class="font-serif text-4xl font-semibold">{{ $purchase->purchase_number }}</h1>
            <p class="mt-2 text-sm text-[#76666B]">Recorded {{ $purchase->created_at->format('F j, Y \a\t g:i A') }}</p>
        </div>
        <a href="{{ route('admin.purchases.create') }}" class="w-fit rounded-full bg-[#D94368] px-5 py-3 text-sm font-semibold text-white hover:bg-[#B83253]">Record another purchase</a>
    </div>
</div>

<div class="grid gap-6 lg:grid-cols-[minmax(0,1fr)_20rem]">
    <section class="overflow-hidden rounded-2xl border border-[#F6ECE8] bg-white shadow-sm">
        <div class="border-b border-[#F6ECE8] px-6 py-4"><h2 class="font-serif text-2xl font-semibold">Received products</h2></div>
        <div class="divide-y divide-[#F6ECE8]">
            @foreach ($purchase->items as $item)
                <div class="flex flex-wrap items-center gap-4 px-6 py-5">
                    <div class="min-w-0 flex-1">
                        <p class="font-semibold">{{ $item->product_name }}</p>
                        <p class="text-sm text-[#76666B]">{{ number_format($item->quantity) }} × Rs. {{ number_format($item->unit_cost) }} unit cost</p>
                    </div>
                    <p class="whitespace-nowrap text-sm font-semibold">Rs. {{ number_format($item->line_total) }}</p>
                </div>
            @endforeach
        </div>
        <div class="flex justify-between border-t border-[#F6ECE8] bg-[#FFF9F7] px-6 py-5 text-base font-bold"><span>Total purchase cost</span><span class="text-[#D94368]">Rs. {{ number_format($purchase->total_amount) }}</span></div>
    </section>

    <aside class="h-fit rounded-2xl border border-[#F6ECE8] bg-white p-6 shadow-sm">
        <p class="text-xs font-bold uppercase tracking-[0.18em] text-[#D94368]">Supplier</p>
        <h2 class="mt-2 font-serif text-2xl font-semibold">{{ $purchase->supplier_name }}</h2>
        @if ($purchase->supplier_email)<p class="mt-3 break-all text-sm text-[#76666B]">{{ $purchase->supplier_email }}</p>@endif
        @if ($purchase->supplier_phone)<p class="mt-1 text-sm text-[#76666B]">{{ $purchase->supplier_phone }}</p>@endif
        @if ($purchase->supplier_reference)<p class="mt-4 border-t border-[#F6ECE8] pt-4 text-sm"><span class="font-semibold">Reference:</span> {{ $purchase->supplier_reference }}</p>@endif
        @if ($purchase->notes)<p class="mt-4 border-t border-[#F6ECE8] pt-4 text-sm leading-6"><span class="font-semibold">Notes:</span> {{ $purchase->notes }}</p>@endif
        <p class="mt-5 rounded-xl bg-[#F9ECE8] p-4 text-sm leading-6 text-[#76666B]">Product stock was increased when this purchase was recorded.</p>
    </aside>
</div>
@endsection

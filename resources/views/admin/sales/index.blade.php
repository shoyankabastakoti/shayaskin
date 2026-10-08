@extends('layouts.admin')

@section('title', 'Sales')

@section('content')
<div class="mb-8">
    <p class="mb-2 text-xs font-bold uppercase tracking-[0.2em] text-[#D94368]">Revenue report</p>
    <h1 class="font-serif text-4xl font-semibold">Sales</h1>
    <p class="mt-2 text-sm text-[#76666B]">Customer order revenue by date. Cancelled orders are excluded.</p>
</div>

<form action="{{ route('admin.sales.index') }}" method="GET" class="mb-6 grid gap-4 rounded-2xl border border-[#F6ECE8] bg-white p-5 sm:grid-cols-[1fr_1fr_auto] sm:items-end">
    <div>
        <label for="start_date" class="mb-2 block text-sm font-semibold">From</label>
        <input id="start_date" name="start_date" type="date" value="{{ $startDate }}" required class="w-full rounded-xl border border-[#F6ECE8] px-4 py-3 outline-none focus:border-[#D94368]">
    </div>
    <div>
        <label for="end_date" class="mb-2 block text-sm font-semibold">To</label>
        <input id="end_date" name="end_date" type="date" value="{{ $endDate }}" required class="w-full rounded-xl border border-[#F6ECE8] px-4 py-3 outline-none focus:border-[#D94368]">
    </div>
    <button class="rounded-xl bg-[#2B2023] px-5 py-3 font-semibold text-white transition hover:bg-[#D94368]">Apply dates</button>
</form>

<section class="mb-6 grid gap-4 sm:grid-cols-3" aria-label="Sales summary">
    <div class="rounded-2xl border border-[#F6ECE8] bg-white p-5 shadow-sm">
        <p class="text-sm font-medium text-[#76666B]">Sales revenue</p>
        <p class="mt-3 font-serif text-3xl font-semibold text-[#D94368]">Rs. {{ number_format($summary['revenue']) }}</p>
    </div>
    <div class="rounded-2xl border border-[#F6ECE8] bg-white p-5 shadow-sm">
        <p class="text-sm font-medium text-[#76666B]">Customer orders</p>
        <p class="mt-3 font-serif text-3xl font-semibold">{{ number_format($summary['orders']) }}</p>
    </div>
    <div class="rounded-2xl border border-[#F6ECE8] bg-white p-5 shadow-sm">
        <p class="text-sm font-medium text-[#76666B]">Average order value</p>
        <p class="mt-3 font-serif text-3xl font-semibold">Rs. {{ number_format($summary['average_order']) }}</p>
    </div>
</section>

<section class="overflow-hidden rounded-2xl border border-[#F6ECE8] bg-white shadow-sm">
    <div class="border-b border-[#F6ECE8] px-5 py-4 sm:px-6">
        <h2 class="font-serif text-2xl font-semibold">Daily sales</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full min-w-[520px] text-left">
            <thead class="bg-[#F9ECE8] text-xs uppercase tracking-wider text-[#76666B]">
                <tr>
                    <th class="px-5 py-4 font-semibold">Date</th>
                    <th class="px-5 py-4 font-semibold">Orders</th>
                    <th class="px-5 py-4 text-right font-semibold">Revenue</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#F6ECE8]">
                @forelse ($dailySales as $day)
                    <tr>
                        <td class="px-5 py-4 font-medium">{{ \Illuminate\Support\Carbon::parse($day->sales_date)->format('F j, Y') }}</td>
                        <td class="px-5 py-4 text-sm text-[#76666B]">{{ number_format($day->orders_count) }}</td>
                        <td class="px-5 py-4 text-right font-semibold">Rs. {{ number_format($day->revenue) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="px-5 py-14 text-center text-[#76666B]">No sales in this date range.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
<div class="mt-6">{{ $dailySales->links() }}</div>
@endsection

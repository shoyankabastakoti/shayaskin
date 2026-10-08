@extends('layouts.admin')

@section('title', 'Orders')

@section('content')
<div class="mb-8">
    <p class="mb-2 text-xs font-bold uppercase tracking-[0.2em] text-[#D94368]">Purchases</p>
    <h1 class="font-serif text-4xl font-semibold">Orders</h1>
    <p class="mt-2 text-sm text-[#76666B]">{{ number_format($orders->total()) }} orders in your store.</p>
</div>

<form action="{{ route('admin.orders.index') }}" method="GET" class="mb-6 grid gap-3 sm:grid-cols-[minmax(0,1fr)_12rem_auto]">
    @if ($email !== '')
        <input type="hidden" name="email" value="{{ $email }}">
    @endif
    <label for="order-search" class="sr-only">Search orders</label>
    <input id="order-search" name="q" value="{{ $search }}" placeholder="Search order number, customer, or email" class="min-w-0 rounded-xl border border-[#F6ECE8] bg-white px-4 py-3 outline-none focus:border-[#D94368]">
    <label for="order-status" class="sr-only">Filter by status</label>
    <select id="order-status" name="status" class="rounded-xl border border-[#F6ECE8] bg-white px-4 py-3 outline-none focus:border-[#D94368]">
        <option value="">All statuses</option>
        @foreach (\App\Models\Order::STATUSES as $orderStatus)
            <option value="{{ $orderStatus }}" @selected($status === $orderStatus)>{{ ucfirst($orderStatus) }}</option>
        @endforeach
    </select>
    <button class="rounded-xl border border-[#F6ECE8] bg-white px-5 py-3 font-semibold text-[#76666B] hover:border-[#D94368] hover:text-[#D94368]">Filter</button>
</form>

<div class="overflow-hidden rounded-2xl border border-[#F6ECE8] bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full min-w-[780px] text-left">
            <thead class="bg-[#F9ECE8] text-xs uppercase tracking-wider text-[#76666B]">
                <tr>
                    <th class="px-5 py-4 font-semibold">Order</th>
                    <th class="px-5 py-4 font-semibold">Customer</th>
                    <th class="px-5 py-4 font-semibold">Date</th>
                    <th class="px-5 py-4 font-semibold">Payment</th>
                    <th class="px-5 py-4 font-semibold">Total</th>
                    <th class="px-5 py-4 font-semibold">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#F6ECE8]">
                @forelse ($orders as $order)
                    <tr>
                        <td class="px-5 py-4"><a href="{{ route('admin.orders.show', $order) }}" class="font-semibold text-[#D94368] hover:text-[#B83253]">{{ $order->order_number }}</a></td>
                        <td class="px-5 py-4"><p class="font-medium">{{ $order->customer_name }}</p><p class="text-sm text-[#76666B]">{{ $order->customer_email }}</p></td>
                        <td class="px-5 py-4 text-sm text-[#76666B]">{{ $order->created_at->format('M j, Y') }}</td>
                        <td class="px-5 py-4 text-sm text-[#76666B]">Cash on delivery</td>
                        <td class="px-5 py-4 text-sm font-semibold">Rs. {{ number_format($order->total_amount) }}</td>
                        <td class="px-5 py-4"><span class="rounded-full bg-[#F9ECE8] px-3 py-1 text-xs font-semibold capitalize text-[#D94368]">{{ $order->status }}</span></td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-5 py-16 text-center text-[#76666B]">No orders match this search.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-6">{{ $orders->links() }}</div>
@endsection

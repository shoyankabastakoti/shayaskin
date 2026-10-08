@extends('layouts.admin')

@section('title', 'Order '.$order->order_number)

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.orders.index') }}" class="mb-4 inline-block text-sm font-semibold text-[#D94368] hover:text-[#B83253]">&larr; Back to orders</a>
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
        <div>
            <p class="mb-2 text-xs font-bold uppercase tracking-[0.2em] text-[#D94368]">Order details</p>
            <h1 class="font-serif text-4xl font-semibold">{{ $order->order_number }}</h1>
            <p class="mt-2 text-sm text-[#76666B]">Placed {{ $order->created_at->format('F j, Y \a\t g:i A') }}</p>
        </div>
        <span class="w-fit rounded-full bg-[#F9ECE8] px-4 py-2 text-sm font-semibold capitalize text-[#D94368]">{{ $order->status }}</span>
    </div>
</div>

<div class="grid gap-6 lg:grid-cols-[minmax(0,1fr)_20rem]">
    <div class="space-y-6">
        <section class="overflow-hidden rounded-2xl border border-[#F6ECE8] bg-white shadow-sm">
            <div class="border-b border-[#F6ECE8] px-6 py-4">
                <h2 class="font-serif text-2xl font-semibold">Items</h2>
            </div>
            <div class="divide-y divide-[#F6ECE8]">
                @foreach ($order->items as $item)
                    <div class="flex items-center gap-4 px-6 py-5">
                        <img src="{{ $item->image }}" alt="" class="h-16 w-14 rounded-lg bg-[#F9ECE8] object-cover">
                        <div class="min-w-0 flex-1">
                            <p class="font-semibold">{{ $item->product_name }}</p>
                            <p class="text-sm text-[#76666B]">{{ $item->brand }} · {{ $item->quantity }} × Rs. {{ number_format($item->unit_price) }}</p>
                        </div>
                        <p class="whitespace-nowrap text-sm font-semibold">Rs. {{ number_format($item->line_total) }}</p>
                    </div>
                @endforeach
            </div>
            <div class="space-y-3 border-t border-[#F6ECE8] bg-[#FFF9F7] px-6 py-5 text-sm">
                <div class="flex justify-between text-[#76666B]"><span>Subtotal</span><span>Rs. {{ number_format($order->subtotal) }}</span></div>
                <div class="flex justify-between text-[#76666B]"><span>Delivery</span><span>Rs. {{ number_format($order->delivery_fee) }}</span></div>
                <div class="flex justify-between border-t border-[#F6ECE8] pt-3 text-base font-bold"><span>Total</span><span class="text-[#D94368]">Rs. {{ number_format($order->total_amount) }}</span></div>
            </div>
        </section>

        <section class="rounded-2xl border border-[#F6ECE8] bg-white p-6 shadow-sm">
            <h2 class="font-serif text-2xl font-semibold">Delivery address</h2>
            <p class="mt-4 font-semibold">{{ $order->customer_name }}</p>
            <p class="mt-1 text-sm text-[#76666B]">{{ $order->customer_email }} · {{ $order->customer_phone }}</p>
            <p class="mt-4 text-sm leading-6">{{ $order->address }}@if ($order->ward), Ward {{ $order->ward }}@endif<br>{{ $order->city }}, {{ $order->district }}<br>{{ $order->province }}</p>
            @if ($order->instructions)
                <p class="mt-4 rounded-xl bg-[#FFF9F7] p-4 text-sm"><span class="font-semibold">Delivery instructions:</span> {{ $order->instructions }}</p>
            @endif
        </section>
    </div>

    <aside class="h-fit rounded-2xl border border-[#F6ECE8] bg-white p-6 shadow-sm">
        <h2 class="font-serif text-2xl font-semibold">Update order</h2>
        <p class="mt-2 text-sm leading-6 text-[#76666B]">Keep the customer purchase status current as it is prepared and delivered.</p>
        <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="mt-5 grid gap-4">
            @csrf
            @method('PATCH')
            <label for="status" class="text-sm font-semibold">Order status</label>
            <select id="status" name="status" required class="rounded-xl border border-[#F6ECE8] bg-white px-4 py-3 outline-none focus:border-[#D94368]">
                @foreach (\App\Models\Order::STATUSES as $status)
                    <option value="{{ $status }}" @selected(old('status', $order->status) === $status)>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
            @error('status') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
            <button class="rounded-xl bg-[#D94368] px-5 py-3 font-semibold text-white transition hover:bg-[#B83253]">Save status</button>
        </form>
        <div class="mt-6 border-t border-[#F6ECE8] pt-5 text-sm">
            <p class="font-semibold">Payment</p>
            <p class="mt-1 capitalize text-[#76666B]">Cash on delivery</p>
        </div>
    </aside>
</div>
@endsection

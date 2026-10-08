@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="mb-8 flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
    <div>
        <p class="mb-2 text-xs font-bold uppercase tracking-[0.2em] text-[#D94368]">Store overview</p>
        <h1 class="font-serif text-4xl font-semibold">Dashboard</h1>
        <p class="mt-2 text-sm text-[#76666B]">A quick view of your catalog, customers, and orders.</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="inline-flex items-center justify-center rounded-full bg-[#D94368] px-6 py-3 font-semibold text-white transition hover:bg-[#B83253]">
        Add a product
    </a>
</div>

<section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4" aria-label="Store metrics">
    @foreach ([
        ['Total orders', number_format($metrics['orders']), route('admin.orders.index'), 'All customer purchases'],
        ['Needs attention', number_format($metrics['pending_orders']), route('admin.orders.index', ['status' => 'pending']), 'Pending orders'],
        ['Customers', number_format($metrics['customers']), route('admin.customers.index'), 'From completed checkouts'],
        ['Products', number_format($metrics['products']), route('admin.products.index'), 'In your catalog'],
        ['Sales total', 'Rs. '.number_format($metrics['sales']), route('admin.sales.index'), 'Excludes cancelled orders'],
        ['Supplier spend', 'Rs. '.number_format($metrics['purchases']), route('admin.purchases.index'), 'Recorded inventory purchases'],
        ['Stock units', number_format($metrics['inventory_units']), route('admin.products.index'), 'Across all products'],
    ] as [$label, $value, $url, $caption])
        <a href="{{ $url }}" class="rounded-2xl border border-[#F6ECE8] bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
            <p class="text-sm font-medium text-[#76666B]">{{ $label }}</p>
            <p class="mt-3 break-words font-serif text-3xl font-semibold text-[#2B2023]">{{ $value }}</p>
            <p class="mt-2 text-xs text-[#9A858B]">{{ $caption }}</p>
        </a>
    @endforeach
</section>

<div class="mt-8 grid gap-6 xl:grid-cols-[minmax(0,1fr)_18rem]">
    <section class="overflow-hidden rounded-2xl border border-[#F6ECE8] bg-white shadow-sm">
        <div class="flex items-center justify-between gap-4 border-b border-[#F6ECE8] px-5 py-4 sm:px-6">
            <div>
                <h2 class="font-serif text-2xl font-semibold">Recent orders</h2>
                <p class="mt-1 text-sm text-[#76666B]">Latest customer purchases and fulfillment status.</p>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="text-sm font-semibold text-[#D94368] hover:text-[#B83253]">All orders</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[650px] text-left">
                <thead class="bg-[#FFF9F7] text-xs uppercase tracking-wider text-[#76666B]">
                    <tr>
                        <th class="px-5 py-3 font-semibold sm:px-6">Order</th>
                        <th class="px-5 py-3 font-semibold">Customer</th>
                        <th class="px-5 py-3 font-semibold">Date</th>
                        <th class="px-5 py-3 font-semibold">Total</th>
                        <th class="px-5 py-3 font-semibold">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#F6ECE8]">
                    @forelse ($recentOrders as $order)
                        <tr>
                            <td class="px-5 py-4 sm:px-6"><a href="{{ route('admin.orders.show', $order) }}" class="font-semibold text-[#D94368] hover:text-[#B83253]">{{ $order->order_number }}</a></td>
                            <td class="px-5 py-4"><p class="font-medium">{{ $order->customer_name }}</p><p class="text-xs text-[#76666B]">{{ $order->customer_email }}</p></td>
                            <td class="px-5 py-4 text-sm text-[#76666B]">{{ $order->created_at->format('M j, Y') }}</td>
                            <td class="px-5 py-4 text-sm font-semibold">Rs. {{ number_format($order->total_amount) }}</td>
                            <td class="px-5 py-4"><span class="rounded-full bg-[#F9ECE8] px-3 py-1 text-xs font-semibold capitalize text-[#D94368]">{{ $order->status }}</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-6 py-14 text-center text-sm text-[#76666B]">No orders yet. Customer purchases will appear here.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <aside class="rounded-2xl border border-[#F6ECE8] bg-white p-6 shadow-sm">
        <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#D94368]">Quick links</p>
        <h2 class="mt-2 font-serif text-2xl font-semibold">Manage your store</h2>
        <div class="mt-5 grid gap-3">
            <a href="{{ route('admin.products.index') }}" class="rounded-xl border border-[#F6ECE8] px-4 py-3 text-sm font-semibold hover:border-[#D94368] hover:text-[#D94368]">Edit product catalog <span class="float-right">&rarr;</span></a>
            <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="rounded-xl border border-[#F6ECE8] px-4 py-3 text-sm font-semibold hover:border-[#D94368] hover:text-[#D94368]">Process pending orders <span class="float-right">&rarr;</span></a>
            <a href="{{ route('admin.sales.index') }}" class="rounded-xl border border-[#F6ECE8] px-4 py-3 text-sm font-semibold hover:border-[#D94368] hover:text-[#D94368]">View sales report <span class="float-right">&rarr;</span></a>
            <a href="{{ route('admin.purchases.create') }}" class="rounded-xl border border-[#F6ECE8] px-4 py-3 text-sm font-semibold hover:border-[#D94368] hover:text-[#D94368]">Record supplier purchase <span class="float-right">&rarr;</span></a>
            <a href="{{ route('admin.customers.index') }}" class="rounded-xl border border-[#F6ECE8] px-4 py-3 text-sm font-semibold hover:border-[#D94368] hover:text-[#D94368]">Browse customers <span class="float-right">&rarr;</span></a>
        </div>
        <p class="mt-6 rounded-xl bg-[#FFF9F7] p-4 text-xs leading-5 text-[#76666B]">Customer profiles are created from checkout details. This store currently uses guest checkout and does not have customer sign-in accounts.</p>
    </aside>
</div>
@endsection

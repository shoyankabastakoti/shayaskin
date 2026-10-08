@extends('layouts.admin')

@section('title', 'Customers')

@section('content')
<div class="mb-8 flex flex-wrap items-end justify-between gap-4">
    <div>
        <p class="mb-3 inline-flex rounded-full bg-[#EEF6EA] px-3 py-1 text-xs font-bold uppercase tracking-[0.16em] text-[#315B45]">Admin section</p>
        <h1 class="font-sans text-4xl font-bold tracking-tight text-[#202936]">Users</h1>
        <p class="mt-2 text-[#718096]">Registered accounts, roles, and customer order records.</p>
    </div>
</div>

<section class="mb-7 grid gap-4 md:grid-cols-3" aria-label="User summary">
    <article class="rounded-3xl border border-slate-100 bg-white p-6 shadow-sm">
        <p class="text-xs font-bold uppercase tracking-[0.18em] text-slate-500">Total users</p>
        <p class="mt-5 text-4xl font-bold text-[#315B45]">{{ number_format($metrics['users']) }}</p>
        <p class="mt-2 text-sm text-slate-500">Registered accounts</p>
    </article>
    <article class="rounded-3xl border border-slate-100 bg-white p-6 shadow-sm">
        <p class="text-xs font-bold uppercase tracking-[0.18em] text-slate-500">Admins</p>
        <p class="mt-5 text-4xl font-bold text-[#315B45]">{{ number_format($metrics['admins']) }}</p>
        <p class="mt-2 text-sm text-slate-500">Administrator accounts</p>
    </article>
    <article class="rounded-3xl border border-slate-100 bg-white p-6 shadow-sm">
        <p class="text-xs font-bold uppercase tracking-[0.18em] text-slate-500">Customers</p>
        <p class="mt-5 text-4xl font-bold text-[#315B45]">{{ number_format($metrics['customers']) }}</p>
        <p class="mt-2 text-sm text-slate-500">Customer accounts</p>
    </article>
</section>

<section class="mb-8 overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-sm">
    <div class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-100 px-6 py-5">
        <div>
            <h2 class="text-sm font-bold uppercase tracking-[0.18em] text-slate-600">Registered users</h2>
            <p class="mt-1 text-sm text-slate-500">{{ number_format($registeredUsers->total()) }} accounts</p>
        </div>
        <form action="{{ route('admin.customers.index') }}" method="GET" class="flex w-full gap-2 sm:w-auto">
            <label for="user-search" class="sr-only">Search registered users</label>
            <input id="user-search" name="q" value="{{ $search }}" placeholder="Search users" class="min-w-0 flex-1 rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm outline-none focus:border-[#D94368] sm:w-64">
            <button class="rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-600 hover:border-[#D94368] hover:text-[#D94368]">Search</button>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full min-w-[900px] text-left">
            <thead class="bg-slate-50 text-xs uppercase tracking-[0.14em] text-slate-500">
                <tr>
                    <th class="w-14 px-6 py-4"></th>
                    <th class="px-4 py-4 font-semibold">Name</th>
                    <th class="px-4 py-4 font-semibold">Email address</th>
                    <th class="px-4 py-4 font-semibold">Role</th>
                    <th class="px-4 py-4 font-semibold">Joined</th>
                    <th class="px-4 py-4 font-semibold">Last login</th>
                    <th class="px-6 py-4 text-right font-semibold">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($registeredUsers as $user)
                    <tr class="hover:bg-slate-50/70">
                        <td class="px-6 py-4">
                            <span class="flex h-10 w-10 items-center justify-center rounded-full bg-[#DDF2F4] text-sm font-semibold text-[#315B6B]">{{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}</span>
                        </td>
                        <td class="px-4 py-4 font-semibold text-slate-800">{{ $user->name }}</td>
                        <td class="px-4 py-4 text-sm text-slate-500">{{ $user->email }}</td>
                        <td class="px-4 py-4 text-sm text-slate-600">{{ $user->is_admin ? 'Admin' : 'Customer' }}</td>
                        <td class="whitespace-nowrap px-4 py-4 text-sm text-slate-500">{{ $user->created_at->format('M j, Y') }}</td>
                        <td class="px-4 py-4 text-sm text-slate-500">Not tracked</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.orders.index', ['email' => $user->email]) }}" class="whitespace-nowrap text-sm font-semibold text-indigo-600 hover:text-indigo-800">View orders</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="px-6 py-14 text-center text-sm text-slate-500">No registered accounts match this search.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($registeredUsers->hasPages())
        <div class="border-t border-slate-100 px-6 py-4">{{ $registeredUsers->links() }}</div>
    @endif
</section>

<section class="overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-sm">
    <div class="border-b border-slate-100 px-6 py-5">
        <h2 class="text-sm font-bold uppercase tracking-[0.18em] text-slate-600">Checkout customers</h2>
        <p class="mt-1 text-sm text-slate-500">{{ number_format($customers->total()) }} customers with orders, including guest checkouts.</p>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full min-w-[760px] text-left">
            <thead class="bg-slate-50 text-xs uppercase tracking-[0.14em] text-slate-500">
                <tr>
                    <th class="px-6 py-4 font-semibold">Customer</th>
                    <th class="px-5 py-4 font-semibold">Phone</th>
                    <th class="px-5 py-4 font-semibold">Orders</th>
                    <th class="px-5 py-4 font-semibold">Total spent</th>
                    <th class="px-5 py-4 font-semibold">Last order</th>
                    <th class="px-6 py-4 text-right font-semibold">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($customers as $customer)
                    <tr class="hover:bg-slate-50/70">
                        <td class="px-6 py-4"><p class="font-semibold text-slate-800">{{ $customer->customer_name }}</p><p class="text-sm text-slate-500">{{ $customer->customer_email }}</p></td>
                        <td class="px-5 py-4 text-sm text-slate-500">{{ $customer->customer_phone }}</td>
                        <td class="px-5 py-4 text-sm">{{ number_format($customer->orders_count) }}</td>
                        <td class="px-5 py-4 text-sm font-semibold">Rs. {{ number_format($customer->total_spent) }}</td>
                        <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-500">{{ \Illuminate\Support\Carbon::parse($customer->last_order_at)->format('M j, Y') }}</td>
                        <td class="px-6 py-4 text-right"><a href="{{ route('admin.orders.index', ['email' => $customer->customer_email]) }}" class="whitespace-nowrap text-sm font-semibold text-indigo-600 hover:text-indigo-800">View orders</a></td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-6 py-14 text-center text-sm text-slate-500">No checkout customers match this search.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($customers->hasPages())
        <div class="border-t border-slate-100 px-6 py-4">{{ $customers->links() }}</div>
    @endif
</section>
@endsection

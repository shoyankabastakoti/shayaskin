<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Product Admin') — Shaya Skin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin-layout min-h-screen bg-[#FFF9F7] font-sans text-[#2B2023] antialiased">
    <aside class="sticky top-0 z-20 border-b border-[#F6ECE8] bg-white lg:fixed lg:inset-y-0 lg:left-0 lg:flex lg:w-64 lg:flex-col lg:border-b-0 lg:border-r">
        <div class="flex flex-wrap items-center justify-between gap-4 px-4 py-4 sm:px-6 lg:block lg:px-5 lg:py-7">
            <a href="{{ route('admin.dashboard') }}" class="font-sans text-2xl font-bold tracking-tight">
                Shaya <span class="font-light text-[#D94368]">Admin</span>
            </a>
            <nav class="flex w-full items-center gap-2 overflow-x-auto pb-1 lg:mt-10 lg:flex-col lg:items-stretch lg:overflow-visible lg:pb-0" aria-label="Admin navigation">
                @foreach ([
                    ['admin.dashboard', 'Dashboard', 'admin.dashboard'],
                    ['admin.products.index', 'Products', 'admin.products.*'],
                    ['admin.orders.index', 'Orders', 'admin.orders.*'],
                    ['admin.sales.index', 'Sales', 'admin.sales.*'],
                    ['admin.customers.index', 'Users', 'admin.customers.*'],
                ] as [$routeName, $label, $activePattern])
                    <a
                        href="{{ route($routeName) }}"
                        @if (request()->routeIs($activePattern)) aria-current="page" @endif
                        @class([
                            'whitespace-nowrap rounded-xl px-4 py-3 text-sm font-semibold transition',
                            'bg-[#F9ECE8] text-[#D94368]' => request()->routeIs($activePattern),
                            'text-[#76666B] hover:bg-[#FFF9F7] hover:text-[#D94368]' => ! request()->routeIs($activePattern),
                        ])
                    >{{ $label }}</a>
                @endforeach
                <details @if (request()->routeIs('admin.settings.*')) open @endif class="group">
                    <summary
                        @if (request()->routeIs('admin.settings.*')) aria-current="page" @endif
                        class="flex cursor-pointer list-none items-center justify-between rounded-xl px-4 py-3 text-sm font-semibold transition marker:hidden [&::-webkit-details-marker]:hidden {{ request()->routeIs('admin.settings.*') ? 'bg-[#F9ECE8] text-[#D94368]' : 'text-[#76666B] hover:bg-[#FFF9F7] hover:text-[#D94368]' }}"
                    >
                        <span>Settings</span>
                        <svg class="h-4 w-4 transition group-open:rotate-180" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.22 7.22a.75.75 0 0 1 1.06 0L10 10.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 8.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd"/>
                        </svg>
                    </summary>
                    <div class="mt-1 grid gap-1 pl-4 lg:pl-5">
                        <a
                            href="{{ route('admin.settings.password.edit') }}"
                            @if (request()->routeIs('admin.settings.password.*')) aria-current="page" @endif
                            @class([
                                'rounded-xl px-4 py-2.5 text-sm font-medium transition',
                                'bg-[#FFF9F7] text-[#D94368]' => request()->routeIs('admin.settings.password.*'),
                                'text-[#76666B] hover:bg-[#FFF9F7] hover:text-[#D94368]' => ! request()->routeIs('admin.settings.password.*'),
                            ])
                        >Change password</a>
                        <a
                            href="{{ route('admin.settings.admins.create') }}"
                            @if (request()->routeIs('admin.settings.admins.*')) aria-current="page" @endif
                            @class([
                                'rounded-xl px-4 py-2.5 text-sm font-medium transition',
                                'bg-[#FFF9F7] text-[#D94368]' => request()->routeIs('admin.settings.admins.*'),
                                'text-[#76666B] hover:bg-[#FFF9F7] hover:text-[#D94368]' => ! request()->routeIs('admin.settings.admins.*'),
                            ])
                        >Create admin</a>
                    </div>
                </details>
            </nav>
        </div>

        <div class="flex items-center gap-2 px-4 pb-4 sm:px-6 lg:mt-auto lg:flex-col lg:items-stretch lg:gap-2 lg:px-5 lg:pb-6">
            <a href="{{ route('home') }}" class="whitespace-nowrap rounded-xl px-4 py-3 text-sm font-semibold text-[#76666B] hover:bg-[#FFF9F7] hover:text-[#D94368]">View store</a>
            <form action="{{ route('admin.logout') }}" method="POST" class="ml-auto lg:ml-0">
                @csrf
                <button class="whitespace-nowrap rounded-xl bg-[#2B2023] px-4 py-3 text-sm font-semibold text-white transition hover:bg-[#D94368] lg:w-full lg:text-left">Log out</button>
            </form>
        </div>
    </aside>

    <main class="mx-auto max-w-[90rem] px-4 py-8 sm:px-6 lg:ml-64 lg:px-8 lg:py-10">
        @if (session('status'))
            <div role="status" class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                {{ session('status') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminCustomerController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->string('q')->trim()->toString();
        $metrics = [
            'users' => User::query()->count(),
            'admins' => User::query()->where('is_admin', true)->count(),
            'customers' => User::query()->where('is_admin', false)->count(),
        ];

        $registeredUsers = User::query()
            ->when($search !== '', function ($query) use ($search): void {
                $query->where(function ($query) use ($search): void {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('created_at')
            ->paginate(10, ['*'], 'users_page')
            ->withQueryString();

        $customers = Order::query()
            ->selectRaw('customer_email, MAX(customer_name) AS customer_name, MAX(customer_phone) AS customer_phone, COUNT(*) AS orders_count, SUM(total_amount) AS total_spent, MAX(created_at) AS last_order_at')
            ->when($search !== '', function ($query) use ($search): void {
                $query->where(function ($query) use ($search): void {
                    $query->where('customer_name', 'like', "%{$search}%")
                        ->orWhere('customer_email', 'like', "%{$search}%")
                        ->orWhere('customer_phone', 'like', "%{$search}%");
                });
            })
            ->groupBy('customer_email')
            ->orderByDesc('last_order_at')
            ->paginate(10, ['*'], 'orders_page')
            ->withQueryString();

        return view('admin.customers.index', compact('customers', 'metrics', 'registeredUsers', 'search'));
    }
}

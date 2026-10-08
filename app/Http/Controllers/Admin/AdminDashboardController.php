<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function __invoke(): View
    {
        $orders = Order::query();
        $metrics = [
            'orders' => (clone $orders)->count(),
            'pending_orders' => (clone $orders)->where('status', 'pending')->count(),
            'customers' => (clone $orders)->distinct()->count('customer_email'),
            'products' => Product::query()->count(),
            'sales' => (clone $orders)->where('status', '!=', 'cancelled')->sum('total_amount'),
            'purchases' => Purchase::query()->sum('total_amount'),
            'inventory_units' => Product::query()->sum('stock_quantity'),
        ];
        $recentOrders = Order::query()->latest()->limit(8)->get();

        return view('admin.dashboard', compact('metrics', 'recentOrders'));
    }
}

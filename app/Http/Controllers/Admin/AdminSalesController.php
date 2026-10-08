<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminSalesController extends Controller
{
    public function index(Request $request): View
    {
        $validated = $request->validate([
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
        ]);
        $startDate = $validated['start_date'] ?? now()->subDays(29)->toDateString();
        $endDate = $validated['end_date'] ?? now()->toDateString();

        $sales = Order::query()
            ->where('status', '!=', 'cancelled')
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate);
        $summary = [
            'revenue' => (clone $sales)->sum('total_amount'),
            'orders' => (clone $sales)->count(),
        ];
        $summary['average_order'] = $summary['orders'] > 0
            ? (int) round($summary['revenue'] / $summary['orders'])
            : 0;
        $dailySales = (clone $sales)
            ->selectRaw('date(created_at) AS sales_date, COUNT(*) AS orders_count, SUM(total_amount) AS revenue')
            ->groupBy('sales_date')
            ->orderByDesc('sales_date')
            ->paginate(20)
            ->withQueryString();

        return view('admin.sales.index', compact('summary', 'dailySales', 'startDate', 'endDate'));
    }
}

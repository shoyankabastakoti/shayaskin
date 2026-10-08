<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AdminPurchaseController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->string('q')->trim()->toString();
        $purchases = Purchase::query()
            ->withCount('items')
            ->when($search !== '', function ($query) use ($search): void {
                $query->where(function ($query) use ($search): void {
                    $query->where('purchase_number', 'like', "%{$search}%")
                        ->orWhere('supplier_name', 'like', "%{$search}%")
                        ->orWhere('supplier_reference', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.purchases.index', compact('purchases', 'search'));
    }

    public function create(): View
    {
        $products = Product::query()->orderBy('name')->get(['id', 'name', 'brand', 'stock_quantity']);

        return view('admin.purchases.create', compact('products'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'supplier_name' => ['required', 'string', 'max:255'],
            'supplier_email' => ['nullable', 'email', 'max:255'],
            'supplier_phone' => ['nullable', 'string', 'max:40'],
            'supplier_reference' => ['nullable', 'string', 'max:100'],
            'notes' => ['nullable', 'string', 'max:5000'],
            'items' => ['required', 'array', 'min:1', 'max:50'],
            'items.*.product_id' => ['required', 'integer', 'distinct', 'exists:products,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1', 'max:65535'],
            'items.*.unit_cost' => ['required', 'integer', 'min:1', 'max:4294967295'],
        ]);

        $maximumAmount = 4_294_967_295;
        $totalAmount = 0;

        foreach ($validated['items'] as $item) {
            $quantity = (int) $item['quantity'];
            $unitCost = (int) $item['unit_cost'];

            if ($unitCost > intdiv($maximumAmount, $quantity)) {
                throw ValidationException::withMessages([
                    'items' => 'The purchase total is too high to process.',
                ]);
            }

            $lineTotal = $unitCost * $quantity;

            if ($totalAmount > $maximumAmount - $lineTotal) {
                throw ValidationException::withMessages([
                    'items' => 'The purchase total is too high to process.',
                ]);
            }

            $totalAmount += $lineTotal;
        }

        $purchase = DB::transaction(function () use ($validated, $totalAmount, $maximumAmount): Purchase {
            $itemsByProduct = collect($validated['items'])->keyBy(fn (array $item): int => (int) $item['product_id']);
            $products = Product::query()
                ->whereKey($itemsByProduct->keys())
                ->orderBy('id')
                ->lockForUpdate()
                ->get()
                ->keyBy('id');

            if ($products->count() !== $itemsByProduct->count()) {
                throw ValidationException::withMessages([
                    'items' => 'One or more selected products are no longer available.',
                ]);
            }

            $purchase = Purchase::query()->create([
                'purchase_number' => 'PUR-'.Str::upper((string) Str::ulid()),
                'supplier_name' => $validated['supplier_name'],
                'supplier_email' => $validated['supplier_email'] ?? null,
                'supplier_phone' => $validated['supplier_phone'] ?? null,
                'supplier_reference' => $validated['supplier_reference'] ?? null,
                'notes' => $validated['notes'] ?? null,
                'total_amount' => $totalAmount,
            ]);

            foreach ($products as $product) {
                $item = $itemsByProduct->get($product->id);
                $quantity = (int) $item['quantity'];

                if ($product->stock_quantity > $maximumAmount - $quantity) {
                    throw ValidationException::withMessages([
                        'items' => "The stock limit would be exceeded for {$product->name}.",
                    ]);
                }

                $lineTotal = (int) $item['unit_cost'] * $quantity;
                $purchase->items()->create([
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'unit_cost' => $item['unit_cost'],
                    'quantity' => $quantity,
                    'line_total' => $lineTotal,
                ]);

                $product->stock_quantity += $quantity;
                $product->save();
            }

            return $purchase;
        });

        return redirect()->route('admin.purchases.show', $purchase)->with('status', 'Supplier purchase recorded and product stock updated.');
    }

    public function show(Purchase $purchase): View
    {
        $purchase->load('items');

        return view('admin.purchases.show', compact('purchase'));
    }
}

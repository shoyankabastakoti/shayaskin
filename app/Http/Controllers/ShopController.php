<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function home(): View
    {
        $bestSellers = collect(ProductService::all())
            ->sortByDesc('reviews')
            ->take(4);

        return view('pages.home', compact('bestSellers'));
    }

    public function skinTypeSelection(Request $request)
    {
        $category = $request->query('category', 'skincare');

        return view('pages.skin-type', compact('category'));
    }

    public function shop(Request $request)
    {
        $products = collect(ProductService::all());

        if ($request->has('category') && $request->category !== 'all') {
            $products = $products->filter(fn ($p) => $p['category'] === $request->category);
        }

        if ($request->has('skin_type') && $request->skin_type !== 'all') {
            $products = $products->filter(fn ($p) => in_array($p['skin_type'], [$request->skin_type, 'all']));
        }

        if ($request->has('q') && ! empty($request->q)) {
            $q = strtolower($request->q);
            $products = $products->filter(function ($p) use ($q) {
                return str_contains(strtolower($p['name']), $q) ||
                       str_contains(strtolower($p['brand']), $q) ||
                       str_contains(strtolower($p['ingredients']), $q);
            });
        }

        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_low':
                    $products = $products->sortBy('price');
                    break;
                case 'price_high':
                    $products = $products->sortByDesc('price');
                    break;
                case 'rating':
                    $products = $products->sortByDesc('rating');
                    break;
            }
        }

        return view('pages.shop', ['products' => $products->values()]);
    }

    public function product($id)
    {
        $product = ProductService::find($id);
        if (! $product) {
            abort(404);
        }

        $related = collect(ProductService::all())
            ->filter(fn ($p) => $p['id'] != $id && ($p['skin_type'] == $product['skin_type'] || $p['category'] == $product['category']))
            ->take(4);

        return view('pages.product', compact('product', 'related'));
    }

    public function cart()
    {
        return view('pages.cart');
    }

    public function checkout(): View
    {
        return view('pages.checkout');
    }

    public function checkoutSubmit(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:40'],
            'email' => ['required', 'email', 'max:255'],
            'province' => ['required', 'string', 'max:100'],
            'district' => ['required', 'string', 'max:100'],
            'city' => ['required', 'string', 'max:100'],
            'ward' => ['nullable', 'integer', 'min:1', 'max:65535'],
            'address' => ['required', 'string', 'max:500'],
            'instructions' => ['nullable', 'string', 'max:5000'],
            'cart_data' => ['required', 'json', 'max:20000'],
        ]);
        $cartItems = json_decode($validated['cart_data'], true, flags: JSON_THROW_ON_ERROR);

        if (! is_array($cartItems) || ! array_is_list($cartItems) || count($cartItems) < 1 || count($cartItems) > 50) {
            throw ValidationException::withMessages([
                'cart_data' => 'Your cart is empty or contains too many items.',
            ]);
        }

        $cartValidator = Validator::make($cartItems, [
            '*.id' => ['required', 'integer', 'distinct', 'exists:products,id'],
            '*.quantity' => ['required', 'integer', 'min:1', 'max:99'],
        ]);

        if ($cartValidator->fails()) {
            throw ValidationException::withMessages([
                'cart_data' => 'Your cart contains invalid products or quantities. Refresh your cart and try again.',
            ]);
        }

        $cartItems = $cartValidator->validated();

        $products = Product::query()
            ->whereIn('id', array_column($cartItems, 'id'))
            ->get()
            ->keyBy('id');

        if ($products->count() !== count($cartItems)) {
            throw ValidationException::withMessages([
                'cart_data' => 'One or more products are no longer available.',
            ]);
        }

        $subtotal = 0;
        $items = [];
        $maximumOrderTotal = 4_294_967_295;

        foreach ($cartItems as $cartItem) {
            $product = $products->get((int) $cartItem['id']);
            $quantity = (int) $cartItem['quantity'];
            $lineTotal = $product->price * $quantity;

            if ($lineTotal > $maximumOrderTotal || $subtotal > $maximumOrderTotal - $lineTotal) {
                throw ValidationException::withMessages([
                    'cart_data' => 'The order total is too high to process.',
                ]);
            }

            $subtotal += $lineTotal;

            $items[] = [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'brand' => $product->brand,
                'image' => $product->image,
                'unit_price' => $product->price,
                'quantity' => $quantity,
                'line_total' => $lineTotal,
            ];
        }

        $deliveryFee = 150;

        if ($subtotal > $maximumOrderTotal - $deliveryFee) {
            throw ValidationException::withMessages([
                'cart_data' => 'The order total is too high to process.',
            ]);
        }

        $order = DB::transaction(function () use ($validated, $subtotal, $deliveryFee, $items): Order {
            $order = Order::query()->create([
                'order_number' => 'SHY-'.Str::upper((string) Str::ulid()),
                'customer_name' => $validated['name'],
                'customer_email' => $validated['email'],
                'customer_phone' => $validated['phone'],
                'province' => $validated['province'],
                'district' => $validated['district'],
                'city' => $validated['city'],
                'ward' => $validated['ward'] ?? null,
                'address' => $validated['address'],
                'instructions' => $validated['instructions'] ?? null,
                'payment_method' => 'cash_on_delivery',
                'status' => 'pending',
                'subtotal' => $subtotal,
                'delivery_fee' => $deliveryFee,
                'total_amount' => $subtotal + $deliveryFee,
            ]);

            $order->items()->createMany($items);

            return $order;
        });

        $request->session()->put('last_order_id', $order->id);

        return redirect()->route('confirmation');
    }

    public function confirmation(): View|RedirectResponse
    {
        $order = Order::query()
            ->with('items')
            ->find(session('last_order_id'));

        if ($order === null) {
            return redirect()->route('shop');
        }

        return view('pages.confirmation', compact('order'));
    }
}

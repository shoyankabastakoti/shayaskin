<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use RuntimeException;

class AdminProductController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->string('q')->trim()->toString();
        $products = Product::query()
            ->when($search !== '', function ($query) use ($search): void {
                $query->where(function ($query) use ($search): void {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('brand', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();

        return view('admin.products.index', compact('products', 'search'));
    }

    public function create(): View
    {
        return view('admin.products.form', ['product' => new Product]);
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        $attributes = $request->validated();
        $attributes['rating'] = $attributes['rating'] ?? 0;
        $attributes['reviews'] = $attributes['reviews'] ?? 0;
        $attributes['stock_quantity'] = $attributes['stock_quantity'] ?? 0;
        $attributes['image'] = $this->storeUploadedImage($request->file('image'));

        try {
            Product::query()->create($attributes);
        } catch (\Throwable $exception) {
            $this->deleteUploadedImage($attributes['image']);

            throw $exception;
        }

        return redirect()->route('admin.products.index')->with('status', 'Product created successfully.');
    }

    public function edit(Product $product): View
    {
        return view('admin.products.form', compact('product'));
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $attributes = $request->validated();
        $previousImage = $product->image;
        $newImage = null;
        $attributes['rating'] = $attributes['rating'] ?? 0;
        $attributes['reviews'] = $attributes['reviews'] ?? 0;
        $attributes['stock_quantity'] = $attributes['stock_quantity'] ?? $product->stock_quantity;

        if ($request->hasFile('image')) {
            $newImage = $this->storeUploadedImage($request->file('image'));
            $attributes['image'] = $newImage;
        } else {
            unset($attributes['image']);
        }

        try {
            $product->update($attributes);
        } catch (\Throwable $exception) {
            if ($newImage !== null) {
                $this->deleteUploadedImage($newImage);
            }

            throw $exception;
        }

        if ($request->hasFile('image')) {
            $this->deleteUploadedImage($previousImage);
        }

        return redirect()->route('admin.products.index')->with('status', 'Product updated successfully.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $image = $product->image;
        $product->delete();
        $this->deleteUploadedImage($image);

        return redirect()->route('admin.products.index')->with('status', 'Product deleted successfully.');
    }

    private function deleteUploadedImage(string $image): void
    {
        if (! Str::startsWith($image, '/storage/products/')) {
            return;
        }

        $path = Str::after($image, '/storage/');

        if (! Storage::disk('public')->delete($path)) {
            Log::warning('Unable to remove uploaded product image.', ['path' => $path]);
        }
    }

    private function storeUploadedImage(UploadedFile $image): string
    {
        $path = $image->store('products', 'public');

        if (! is_string($path)) {
            throw new RuntimeException('Unable to save the product image.');
        }

        return '/storage/'.$path;
    }
}

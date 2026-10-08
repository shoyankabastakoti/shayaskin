<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    /**
     * @return array<int, array<string, mixed>>
     */
    public static function all(): array
    {
        return Product::query()
            ->orderBy('id')
            ->get()
            ->map(fn (Product $product): array => $product->toArray())
            ->all();
    }

    /**
     * @return array<string, mixed>|null
     */
    public static function find(int|string $id): ?array
    {
        $product = Product::query()->find($id);

        return $product?->toArray();
    }
}

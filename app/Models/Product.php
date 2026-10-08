<?php

namespace App\Models;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name',
    'brand',
    'description',
    'price',
    'category',
    'skin_type',
    'image',
    'rating',
    'reviews',
    'ingredients',
    'how_to_use',
    'benefits',
    'stock_quantity',
])]
class Product extends Model
{
    /** @use HasFactory<ProductFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'price' => 'integer',
            'rating' => 'float',
            'reviews' => 'integer',
            'stock_quantity' => 'integer',
        ];
    }
}

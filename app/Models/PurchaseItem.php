<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'purchase_id',
    'product_id',
    'product_name',
    'unit_cost',
    'quantity',
    'line_total',
])]
class PurchaseItem extends Model
{
    protected function casts(): array
    {
        return [
            'unit_cost' => 'integer',
            'quantity' => 'integer',
            'line_total' => 'integer',
        ];
    }

    public function purchase(): BelongsTo
    {
        return $this->belongsTo(Purchase::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}

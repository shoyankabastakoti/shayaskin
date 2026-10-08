<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'purchase_number',
    'supplier_name',
    'supplier_email',
    'supplier_phone',
    'supplier_reference',
    'notes',
    'total_amount',
])]
class Purchase extends Model
{
    protected function casts(): array
    {
        return [
            'total_amount' => 'integer',
        ];
    }

    public function items(): HasMany
    {
        return $this->hasMany(PurchaseItem::class);
    }
}

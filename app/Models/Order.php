<?php

namespace App\Models;

use Database\Factories\OrderFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'order_number',
    'customer_name',
    'customer_email',
    'customer_phone',
    'province',
    'district',
    'city',
    'ward',
    'address',
    'instructions',
    'payment_method',
    'status',
    'subtotal',
    'delivery_fee',
    'total_amount',
])]
class Order extends Model
{
    /** @use HasFactory<OrderFactory> */
    use HasFactory;

    public const STATUSES = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];

    protected function casts(): array
    {
        return [
            'ward' => 'integer',
            'subtotal' => 'integer',
            'delivery_fee' => 'integer',
            'total_amount' => 'integer',
        ];
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}

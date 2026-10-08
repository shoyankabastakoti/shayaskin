<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'order_number' => 'SHY-'.fake()->unique()->bothify('##########'),
            'customer_name' => fake()->name(),
            'customer_email' => fake()->unique()->safeEmail(),
            'customer_phone' => fake()->phoneNumber(),
            'province' => 'Bagmati',
            'district' => 'Kathmandu',
            'city' => 'Kathmandu',
            'ward' => 1,
            'address' => fake()->streetAddress(),
            'payment_method' => 'cash_on_delivery',
            'status' => 'pending',
            'subtotal' => 1000,
            'delivery_fee' => 150,
            'total_amount' => 1150,
        ];
    }
}

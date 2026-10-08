<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'brand' => fake()->company(),
            'description' => fake()->sentence(),
            'price' => fake()->numberBetween(500, 10000),
            'category' => fake()->randomElement(['makeup', 'skincare']),
            'skin_type' => fake()->randomElement(['oily', 'dry', 'combination', 'all']),
            'image' => '/images/products/skincare_products.jpg',
            'rating' => fake()->randomFloat(1, 3, 5),
            'reviews' => fake()->numberBetween(0, 1000),
            'stock_quantity' => 0,
            'ingredients' => fake()->words(4, true),
            'how_to_use' => fake()->sentence(),
            'benefits' => fake()->sentence(),
        ];
    }
}

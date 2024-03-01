<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
            'product_category_id' => fake()->numberBetween(1, 12),
            'product_name' => fake()->word(),
            'product_description' => fake()->sentence(),
            'product_status' => 'Available',
            'product_stock' => fake()->numberBetween(1, 1000),
            'product_sold' => fake()->numberBetween(0, 9999),
            'product_price' => fake()->randomFloat(2, 10, 1000),
            'product_rating' =>  fake()->numberBetween(0, 5),
            'product_votes' =>  fake()->numberBetween(0, 9999),
            'product_code' => 'AJM-' . fake()->unique()->bothify('??#?#?##'),
            'product_image' => fake()->imageUrl($width = 640, $height = 480),
        ];
    }
}

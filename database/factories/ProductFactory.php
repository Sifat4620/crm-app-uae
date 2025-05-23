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
        $price = random_int(1000, 10000) / 100;
        return [
            'category_id' => random_int(1, 5),
            'name' => $this->faker->colorName(),
            'price' => $price,
            'stock_quantity' => random_int(5, 15),
        ];
    }
}

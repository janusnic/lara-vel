<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\ProductStatus;

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
        $brands = \DB::table('brands')->pluck('id');
        $categories = \DB::table('categories')->pluck('id');
        $name = $this->faker->catchPhrase();

        return [
            'name' => $name,
            'description' => $this->faker->text(),
            'price' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 9000),
            'status' => $this->faker->randomElement(ProductStatus::values()),
            'brand_id' => $this->faker->randomElement($brands),
            'category_id' => $this->faker->randomElement($categories),
            'cover' => $this->faker->imageUrl(400, 300, 'animals', true),
        ];
    }
}

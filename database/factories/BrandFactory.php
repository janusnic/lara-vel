<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $name = $this->faker->company();
        return [
            'name' => $this->faker->company(),
            // 'slug' => Str::of($name)->slug('-'),
            'description' => $this->faker->catchPhrase(),
        ];
    }
}

<?php

// Product/Database/Factories/ProductModelFactory.php

declare(strict_types=1);

namespace Modules\Product\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

final class ProductModelFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name_ar' => fake()->words(3, true),
            'name_en' => fake()->optional()->words(3, true),
            'description_ar' => fake()->paragraph(),
            'description_en' => fake()->optional()->paragraph(),
            'price' => fake()->randomFloat(2, 10, 1000),
            'currency' => 'SAR',
            'image_url' => fake()->optional()->imageUrl(640, 480, 'products'),
            'is_active' => fake()->boolean(90),
            'sort_order' => fake()->numberBetween(1, 100),
        ];
    }

    public function active(): static
    {
        return $this->state(fn (array $attributes): array => ['is_active' => true]);
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes): array => ['is_active' => false]);
    }
}

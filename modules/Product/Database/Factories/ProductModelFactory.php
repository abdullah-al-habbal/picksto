<?php

// Product/Database/Factories/ProductModelFactory.php

declare(strict_types=1);

namespace Modules\Product\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Product\Models\ProductModel;

final class ProductModelFactory extends Factory
{
    protected $model = ProductModel::class;

    public function definition(): array
    {
        return [
            'name' => [
                'ar' => fake('ar_SA')->words(3, true),
                'en' => fake()->words(3, true),
            ],
            'description' => [
                'ar' => fake('ar_SA')->optional(0.7)->paragraph(),
                'en' => fake()->optional(0.7)->paragraph(),
            ],
            'price' => fake()->randomFloat(2, 10, 1000),
            'currency' => 'SAR',
            'image_url' => fake()->optional()->imageUrl(640, 480, 'products'),
            'is_active' => fake()->boolean(90),
            'sort_order' => fake()->numberBetween(1, 100),
        ];
    }

    public function active(): static
    {
        return $this->state(fn(array $attributes): array => ['is_active' => true]);
    }

    public function inactive(): static
    {
        return $this->state(fn(array $attributes): array => ['is_active' => false]);
    }
}

<?php

// modules/Package/Database/Factories/PackageModelFactory.php

declare(strict_types=1);

namespace Modules\Package\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

final class PackageModelFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => [
                'ar' => fake('ar_SA')->words(2, true),
                'en' => fake()->words(2, true),
            ],
            'description' => [
                'ar' => fake('ar_SA')->optional(0.7)->paragraph(),
                'en' => fake()->optional(0.7)->paragraph(),
            ],
            'price' => fake()->randomFloat(2, 10, 500),
            'currency' => fake()->randomElement(['SAR', 'USD', 'EUR']),
            'daily_limit' => fake()->randomElement([5, 10, 20, 50]),
            'monthly_limit' => fake()->randomElement([50, 100, 200, 500]),
            'allowed_sites' => json_encode(fake()->randomElements(['Freepik', 'Flaticon', 'Envato Elements', 'MotionArray', 'Shutterstock'], fake()->numberBetween(1, 5))),
            'duration_days' => fake()->randomElement([7, 30, 90, 365]),
            'is_active' => fake()->boolean(90),
        ];
    }

    public function active(): static
    {
        return $this->state(fn (array $attributes): array => [
            'is_active' => true,
        ]);
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes): array => [
            'is_active' => false,
        ]);
    }

    public function freepikOnly(): static
    {
        return $this->state(fn (array $attributes): array => [
            'allowed_sites' => json_encode(['Freepik']),
        ]);
    }

    public function allSites(): static
    {
        return $this->state(fn (array $attributes): array => [
            'allowed_sites' => json_encode(['All']),
        ]);
    }
}

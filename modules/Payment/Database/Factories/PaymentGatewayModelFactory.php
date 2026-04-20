<?php
// Payment/Database/Factories/PaymentGatewayModelFactory.php

declare(strict_types=1);

namespace Modules\Payment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Payment\Models\PaymentGatewayModel;

final class PaymentGatewayModelFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'type' => fake()->randomElement(['stripe', 'paypal', 'manual', 'lemonsqueezy']),
            'description' => fake()->optional()->sentence(),
            'config' => json_encode(['test_mode' => true]),
            'is_active' => fake()->boolean(90),
            'sort_order' => fake()->numberBetween(1, 100),
        ];
    }

    public function active(): static
    {
        return $this->state(fn (array $attributes): array => ['is_active' => true]);
    }

    public function manual(): static
    {
        return $this->state(fn (array $attributes): array => ['type' => 'manual']);
    }
}

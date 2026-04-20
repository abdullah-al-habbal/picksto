<?php
// Payment/Database/Factories/SubscriptionRequestModelFactory.php

declare(strict_types=1);

namespace Modules\Payment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Package\Models\PackageModel;
use Modules\User\Models\UserModel;

final class SubscriptionRequestModelFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => UserModel::factory(),
            'package_id' => PackageModel::factory(),
            'gateway_id' => null,
            'status' => fake()->randomElement(['pending', 'approved', 'rejected', 'completed']),
            'transaction_id' => fake()->optional()->uuid(),
            'amount' => fake()->randomFloat(2, 10, 500),
            'currency' => 'SAR',
            'user_notes' => fake()->optional()->sentence(),
            'admin_notes' => null,
            'approved_at' => null,
            'approved_by' => null,
        ];
    }

    public function pending(): static
    {
        return $this->state(fn (array $attributes): array => ['status' => 'pending']);
    }

    public function approved(): static
    {
        return $this->state(fn (array $attributes): array => [
            'status' => 'approved',
            'approved_at' => now(),
        ]);
    }

    public function rejected(): static
    {
        return $this->state(fn (array $attributes): array => ['status' => 'rejected']);
    }
}

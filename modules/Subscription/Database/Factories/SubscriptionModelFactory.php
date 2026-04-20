<?php
// modules/Subscription/Database/Factories/SubscriptionModelFactory.php

declare(strict_types=1);

namespace Modules\Subscription\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Package\Models\PackageModel;
use Modules\Subscription\Models\SubscriptionModel;
use Modules\User\Models\UserModel;

final class SubscriptionModelFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => UserModel::factory(),
            'package_id' => PackageModel::factory(),
            'status' => fake()->randomElement(['pending', 'active', 'expired', 'cancelled']),
            'start_date' => fake()->optional()->dateTimeBetween('-30 days', 'now'),
            'end_date' => fake()->optional()->dateTimeBetween('now', '+365 days'),
            'downloads_today' => fake()->numberBetween(0, 50),
            'downloads_month' => fake()->numberBetween(0, 500),
            'last_download_date' => fake()->optional()->dateTimeBetween('-7 days', 'now'),
            'payment_method' => fake()->optional()->randomElement(['stripe', 'paypal', 'manual', 'lemonsqueezy']),
            'transaction_id' => fake()->optional()->uuid(),
        ];
    }

    public function active(): static
    {
        return $this->state(fn (array $attributes): array => [
            'status' => 'active',
            'start_date' => now(),
            'end_date' => now()->addDays(30),
        ]);
    }

    public function pending(): static
    {
        return $this->state(fn (array $attributes): array => [
            'status' => 'pending',
            'start_date' => null,
            'end_date' => null,
        ]);
    }

    public function expired(): static
    {
        return $this->state(fn (array $attributes): array => [
            'status' => 'expired',
            'start_date' => now()->subDays(60),
            'end_date' => now()->subDays(30),
        ]);
    }

    public function cancelled(): static
    {
        return $this->state(fn (array $attributes): array => [
            'status' => 'cancelled',
        ]);
    }

    public function withDownloads(int $today, int $month): static
    {
        return $this->state(fn (array $attributes): array => [
            'downloads_today' => $today,
            'downloads_month' => $month,
        ]);
    }
}

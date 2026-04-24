<?php

// modules/User/Database/Factories/UserModelFactory.php

declare(strict_types=1);

namespace Modules\User\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\User\Models\UserModel;

final class UserModelFactory extends Factory
{
    protected $model = UserModel::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('password123'),
            'phone' => fake()->optional()->phoneNumber(),
            'phone_verified' => fake()->boolean(30),
            'email_verified' => fake()->boolean(70),
            'role' => fake()->randomElement(['user', 'admin', 'supervisor']),
            'is_banned' => fake()->boolean(5),
            'avatar' => fake()->optional()->imageUrl(200, 200, 'people'),
            'referral_code' => strtoupper(Str::random(6)),
            'referred_by' => null,
            'profession' => fake()->optional()->jobTitle(),
            'company_size' => fake()->optional()->randomElement(['1-10', '11-50', '51-200', '200+']),
            'last_login_at' => fake()->optional()->dateTimeBetween('-30 days', 'now'),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes): array => [
            'email_verified' => false,
            'phone_verified' => false,
        ]);
    }

    public function admin(): static
    {
        return $this->state(fn (array $attributes): array => [
            'role' => 'admin',
            'email_verified' => true,
        ]);
    }

    public function supervisor(): static
    {
        return $this->state(fn (array $attributes): array => [
            'role' => 'supervisor',
            'email_verified' => true,
        ]);
    }

    public function banned(): static
    {
        return $this->state(fn (array $attributes): array => [
            'is_banned' => true,
        ]);
    }

    public function withReferrer(int $referrerId): static
    {
        return $this->state(fn (array $attributes): array => [
            'referred_by' => $referrerId,
        ]);
    }
}

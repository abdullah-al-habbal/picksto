<?php

declare(strict_types=1);

namespace Modules\Verification\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\User\Models\UserModel;
use Modules\Verification\Models\VerificationCodeModel;

final class VerificationCodeModelFactory extends Factory
{
    protected $model = VerificationCodeModel::class;

    public function definition(): array
    {
        return [
            'user_id' => UserModel::factory(),
            'code' => fake()->numerify('######'),
            'type' => fake()->randomElement(['email', 'whatsapp']),
            'purpose' => fake()->randomElement(['registration', 'reset']),
            'expires_at' => now()->addMinutes(15),
            'is_used' => false,
        ];
    }

    public function used(): static
    {
        return $this->state(fn(array $attributes): array => ['is_used' => true]);
    }

    public function expired(): static
    {
        return $this->state(fn(array $attributes): array => ['expires_at' => now()->subMinutes(5)]);
    }
}

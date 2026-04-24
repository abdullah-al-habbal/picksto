<?php

// Ticket/Database/Factories/TicketModelFactory.php

declare(strict_types=1);

namespace Modules\Ticket\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Ticket\Models\TicketModel;
use Modules\User\Models\UserModel;

final class TicketModelFactory extends Factory
{
    protected $model = TicketModel::class;

    public function definition(): array
    {
        return [
            'user_id' => UserModel::factory(),
            'subject' => fake()->sentence(),
            'message' => fake()->paragraph(),
            'status' => fake()->randomElement(['open', 'pending', 'closed', 'resolved']),
            'priority' => fake()->randomElement(['low', 'medium', 'high']),
        ];
    }

    public function open(): static
    {
        return $this->state(fn(array $attributes): array => ['status' => 'open']);
    }

    public function highPriority(): static
    {
        return $this->state(fn(array $attributes): array => ['priority' => 'high']);
    }
}

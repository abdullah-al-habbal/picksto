<?php

declare(strict_types=1);

namespace Modules\Website\Handlers;

use Modules\Ticket\Models\TicketModel;
use Modules\User\Models\UserModel;
use Modules\Website\Resolvers\CreateTicketResolver;

final class CreateTicketHandler
{
    public function __construct(
        private readonly CreateTicketResolver $resolver,
    ) {}

    public function handle(array $data): TicketModel
    {
        $user = $this->resolveUser($data['email'], $data['name']);

        return $this->resolver->create([
            'user_id' => $user->id,
            'subject' => $data['subject'],
            'message' => $this->formatMessage($data),
            'priority' => 'medium',
            'status' => 'open',
        ]);
    }

    private function resolveUser(string $email, string $name): UserModel
    {
        $user = UserModel::query()->where('email', $email)->first();

        if ($user) {
            return $user;
        }

        if (auth()->check()) {
            return auth()->user();
        }

        $guest = UserModel::query()->first();
        if ($guest) {
            return $guest;
        }

        return UserModel::query()->create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt(str()->random(32)),
            'role' => 'user',
        ]);
    }

    private function formatMessage(array $data): string
    {
        return "From: {$data['name']} ({$data['email']})\n\n{$data['message']}";
    }
}

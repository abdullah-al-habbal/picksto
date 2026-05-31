<?php

declare(strict_types=1);

namespace Modules\Website\Resolvers;

use Modules\Ticket\Models\TicketModel;

final class CreateTicketResolver
{
    public function __construct(
        private readonly TicketModel $ticketModel,
    ) {}

    public function create(array $data): TicketModel
    {
        return $this->ticketModel->newQuery()->create([
            'user_id' => $data['user_id'],
            'subject' => $data['subject'],
            'message' => $data['message'],
            'priority' => $data['priority'] ?? 'medium',
            'status' => $data['status'] ?? 'open',
        ]);
    }
}

<?php

// Ticket/Presenters/TicketPresenter.php

declare(strict_types=1);

namespace Modules\Ticket\Presenters;

use Modules\Ticket\Models\TicketModel;

final class TicketPresenter
{
    public function presentList(TicketModel $ticket): array
    {
        return [
            'id' => $ticket->id,
            'subject' => $ticket->subject,
            'status' => $ticket->status,
            'priority' => $ticket->priority,
            'createdAt' => $ticket->created_at?->format('Y-m-d H:i'),
        ];
    }

    public function presentAdminList(TicketModel $ticket): array
    {
        return [
            'id' => $ticket->id,
            'user' => $ticket->user?->name ?? 'Unknown',
            'userEmail' => $ticket->user?->email,
            'subject' => $ticket->subject,
            'status' => $ticket->status,
            'priority' => $ticket->priority,
            'createdAt' => $ticket->created_at?->format('Y-m-d H:i'),
        ];
    }

    public function presentDetailed(TicketModel $ticket): array
    {
        return [
            'id' => $ticket->id,
            'subject' => $ticket->subject,
            'message' => $ticket->message,
            'status' => $ticket->status,
            'priority' => $ticket->priority,
            'createdAt' => $ticket->created_at?->format('Y-m-d H:i'),
            'replies' => $ticket->replies->map(fn ($r) => [
                'id' => $r->id,
                'user' => $r->user?->name ?? 'System',
                'message' => $r->message,
                'isAdmin' => $r->is_admin,
                'createdAt' => $r->created_at?->format('Y-m-d H:i'),
            ])->toArray(),
        ];
    }
}

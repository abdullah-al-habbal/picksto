<?php

// Ticket/Repositories/TicketRepository.php

declare(strict_types=1);

namespace Modules\Ticket\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Modules\Ticket\Models\TicketModel;
use Modules\Ticket\Models\TicketReplyModel;

final class TicketRepository
{
    public function __construct(
        private readonly TicketModel $ticketModel,
        private readonly TicketReplyModel $replyModel,
    ) {}

    public function create(int $userId, array $data): TicketModel
    {
        return $this->ticketModel->newQuery()->create([
            'user_id' => $userId,
            'subject' => $data['subject'],
            'message' => $data['message'],
            'priority' => $data['priority'] ?? 'medium',
            'status' => 'open',
        ]);
    }

    public function getUserTickets(int $userId): Collection
    {
        return $this->ticketModel->newQuery()
            ->byUser($userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getAllWithPagination(?string $status = null, ?string $priority = null): LengthAwarePaginator
    {
        $query = $this->ticketModel->newQuery()->with('user');

        if ($status) {
            $query->where('status', $status);
        }
        if ($priority) {
            $query->where('priority', $priority);
        }

        return $query->orderBy('created_at', 'desc')->paginate(20);
    }

    public function addReply(int $ticketId, array $data): TicketReplyModel
    {
        $isAdmin = auth()->user()?->role === 'admin' || auth()->user()?->role === 'supervisor';

        $reply = $this->replyModel->newQuery()->create([
            'ticket_id' => $ticketId,
            'user_id'   => $data['user_id'],
            'message'   => $data['content'],
            'is_admin'  => $isAdmin,
        ]);

        if (! $isAdmin) {
            $this->ticketModel->newQuery()->where('id', $ticketId)->update(['status' => 'pending']);
        }

        return $reply;
    }

    public function getStats(): array
    {
        return $this->ticketModel->newQuery()
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();
    }

    public function updateStatus(int $ticketId, string $status): TicketModel
    {
        $ticket = $this->ticketModel->newQuery()->findOrFail($ticketId);
        $ticket->status = $status;
        $ticket->save();

        return $ticket;
    }

    public function delete(int $ticketId): bool
    {
        return $this->ticketModel->newQuery()->where('id', $ticketId)->delete();
    }

    public function authorizeView(int $userId, int $ticketId): void
    {
        $exists = $this->ticketModel->newQuery()
            ->where('id', $ticketId)
            ->where(function ($q) use ($userId): void {
                $q->where('user_id', $userId)->orWhereRaw('1=0');
            })
            ->exists();

        if (! $exists && ! app('request')->user()?->isAdmin()) {
            abort(403);
        }
    }
}

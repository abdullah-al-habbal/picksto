<?php

// Ticket/Http/Actions/GetTicketsStatsAction.php

declare(strict_types=1);

namespace Modules\Ticket\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Ticket\Repositories\TicketRepository;

final class GetTicketsStatsAction
{
    public function __construct(
        private readonly TicketRepository $ticketRepository,
    ) {}

    public function __invoke(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'stats' => $this->ticketRepository->getStats(),
        ]);
    }
}

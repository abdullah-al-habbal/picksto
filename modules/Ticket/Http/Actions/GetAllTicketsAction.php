<?php

// Ticket/Http/Actions/GetAllTicketsAction.php

declare(strict_types=1);

namespace Modules\Ticket\Http\Actions;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Ticket\Presenters\TicketPresenter;
use Modules\Ticket\Repositories\TicketRepository;

final class GetAllTicketsAction
{
    public function __construct(
        private readonly TicketRepository $ticketRepository,
        private readonly TicketPresenter $ticketPresenter,
    ) {}

    public function __invoke(Request $request): View
    {
        $tickets = $this->ticketRepository->getAllWithPagination(
            $request->get('status'),
            $request->get('priority')
        );

        return view('ticket::admin.index', [
            'tickets' => $tickets->map(fn ($t) => $this->ticketPresenter->presentAdminList($t)),
            'status' => $request->get('status'),
            'priority' => $request->get('priority'),
        ]);
    }
}

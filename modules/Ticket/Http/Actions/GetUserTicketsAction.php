<?php

// Ticket/Http/Actions/GetUserTicketsAction.php

declare(strict_types=1);

namespace Modules\Ticket\Http\Actions;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Ticket\Presenters\TicketPresenter;
use Modules\Ticket\Repositories\TicketRepository;

final class GetUserTicketsAction
{
    public function __construct(
        private readonly TicketRepository $ticketRepository,
        private readonly TicketPresenter $ticketPresenter,
    ) {}

    public function __invoke(Request $request): View
    {
        $tickets = $this->ticketRepository->getUserTickets($request->user()->id);

        return view('ticket::user.index', [
            'tickets' => $tickets->map(fn ($t) => $this->ticketPresenter->presentList($t)),
        ]);
    }
}

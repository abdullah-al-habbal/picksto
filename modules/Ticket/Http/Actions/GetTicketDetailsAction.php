<?php
// Ticket/Http/Actions/GetTicketDetailsAction.php

declare(strict_types=1);

namespace Modules\Ticket\Http\Actions;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Ticket\Models\TicketModel;
use Modules\Ticket\Presenters\TicketPresenter;
use Modules\Ticket\Repositories\TicketRepository;

final class GetTicketDetailsAction
{
    public function __construct(
        private readonly TicketRepository $ticketRepository,
        private readonly TicketPresenter $ticketPresenter,
    ) {
    }

    public function __invoke(Request $request, TicketModel $ticket): View
    {
        $this->ticketRepository->authorizeView($request->user()->id, $ticket->id);
        $data = $this->ticketPresenter->presentDetailed($ticket);
        return view('ticket::user.show', compact('data'));
    }
}
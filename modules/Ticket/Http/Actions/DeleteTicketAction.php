<?php
// Ticket/Http/Actions/DeleteTicketAction.php

declare(strict_types=1);

namespace Modules\Ticket\Http\Actions;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Modules\Ticket\Models\TicketModel;
use Modules\Ticket\Repositories\TicketRepository;

final class DeleteTicketAction
{
    public function __construct(
        private readonly TicketRepository $ticketRepository,
    ) {
    }

    public function __invoke(TicketModel $ticket): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->ticketRepository->delete($ticket->id);
            DB::commit();
            return redirect()->route('web.admin.tickets.index')
                ->with('success', __('ticket::messages.deleted'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', __('ticket::errors.delete_failed'));
        }
    }
}
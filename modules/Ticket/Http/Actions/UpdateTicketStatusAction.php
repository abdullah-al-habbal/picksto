<?php

// Ticket/Http/Actions/UpdateTicketStatusAction.php

declare(strict_types=1);

namespace Modules\Ticket\Http\Actions;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Modules\Ticket\Models\TicketModel;
use Modules\Ticket\Repositories\TicketRepository;

final class UpdateTicketStatusAction
{
    public function __construct(
        private readonly TicketRepository $ticketRepository,
    ) {}

    public function __invoke(TicketModel $ticket): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->ticketRepository->updateStatus($ticket->id);
            DB::commit();

            return redirect()->back()->with('success', __('ticket::messages.status_updated'));
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', __('ticket::errors.status_update_failed'));
        }
    }
}

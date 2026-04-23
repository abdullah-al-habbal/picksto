<?php

// Ticket/Http/Actions/AddReplyAction.php

declare(strict_types=1);

namespace Modules\Ticket\Http\Actions;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Modules\Ticket\Http\Requests\StoreReplyRequest;
use Modules\Ticket\Models\TicketModel;
use Modules\Ticket\Repositories\TicketRepository;

final class AddReplyAction
{
    public function __construct(
        private readonly TicketRepository $ticketRepository,
    ) {}

    public function __invoke(StoreReplyRequest $request, TicketModel $ticket): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->ticketRepository->authorizeView($request->user()->id, $ticket->id);
            $this->ticketRepository->addReply(
                $ticket->id,
                $request->user()->id,
                $request->user()->role === 'admin',
                $request->validated('message')
            );
            DB::commit();

            return redirect()->back()->with('success', __('ticket::messages.reply_added'));
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->withInput()->with('error', __('ticket::errors.reply_failed'));
        }
    }
}

<?php
// Ticket/Http/Actions/CreateTicketAction.php

declare(strict_types=1);

namespace Modules\Ticket\Http\Actions;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Modules\Ticket\Http\Requests\StoreTicketRequest;
use Modules\Ticket\Repositories\TicketRepository;

final class CreateTicketAction
{
    public function __construct(
        private readonly TicketRepository $ticketRepository,
    ) {
    }

    public function __invoke(StoreTicketRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $ticket = $this->ticketRepository->create(
                $request->user()->id,
                $request->validated()
            );
            DB::commit();
            return redirect()->route('web.tickets.show', $ticket->id)
                ->with('success', __('ticket::messages.created'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', __('ticket::errors.create_failed'));
        }
    }
}
<?php

// Ticket/Routes/web.php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Ticket\Http\Actions\AddReplyAction;
use Modules\Ticket\Http\Actions\CreateTicketAction;
use Modules\Ticket\Http\Actions\GetTicketDetailsAction;
use Modules\Ticket\Http\Actions\GetUserTicketsAction;

Route::middleware('auth')->prefix('tickets')->name('tickets.')->group(static function (): void {
    Route::post('/', CreateTicketAction::class)->name('store');
    Route::get('my-tickets', GetUserTicketsAction::class)->name('my-tickets');
    Route::get('{ticket}', GetTicketDetailsAction::class)->name('show');
    Route::post('{ticket}/reply', AddReplyAction::class)->name('reply');
});

<?php
// Ticket/Routes/web.php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Ticket\Http\Actions\{
    CreateTicketAction,
    GetUserTicketsAction,
    GetTicketDetailsAction,
    AddReplyAction,
    GetAllTicketsAction,
    GetTicketsStatsAction,
    UpdateTicketStatusAction,
    DeleteTicketAction
};


Route::middleware('auth')->prefix('tickets')->name('tickets.')->group(static function (): void {
    Route::post('/', CreateTicketAction::class)->name('store');
    Route::get('my-tickets', GetUserTicketsAction::class)->name('my-tickets');
    Route::get('{ticket}', GetTicketDetailsAction::class)->name('show');
    Route::post('{ticket}/reply', AddReplyAction::class)->name('reply');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin/tickets')->name('admin.tickets.')->group(static function (): void {
    Route::get('stats/overview', GetTicketsStatsAction::class)->name('stats');
    Route::get('/', GetAllTicketsAction::class)->name('index');
    Route::put('{ticket}/status', UpdateTicketStatusAction::class)->name('status.update');
    Route::delete('{ticket}', DeleteTicketAction::class)->name('destroy');
});
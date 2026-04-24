<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Admin\Resources\Tables;

use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\Ticket\Filament\Admin\Actions\TicketActions;

final class TicketsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('#ID')
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label(__('ticket::ticket.fields.user'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('subject')
                    ->label(__('ticket::ticket.fields.subject'))
                    ->searchable()
                    ->limit(50),

                TextColumn::make('status')
                    ->label(__('ticket::ticket.fields.status'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'open' => 'success',
                        'pending' => 'warning',
                        'closed' => 'gray',
                        'resolved' => 'primary',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('priority')
                    ->label(__('ticket::ticket.fields.priority'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'high' => 'danger',
                        'medium' => 'warning',
                        'low' => 'success',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label(__('dashboard.fields.created_at'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->recordActions([
                ViewAction::make(),
                TicketActions::changeStatus(),
                TicketActions::addReply(),
            ])
            ->emptyStateHeading(__('ticket::ticket.labels.no_tickets'));
    }
}

<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Admin\Resources\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
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
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'open' => __('ticket::ticket.statuses.open'),
                        'pending' => __('ticket::ticket.statuses.pending'),
                        'closed' => __('ticket::ticket.statuses.closed'),
                        'resolved' => __('ticket::ticket.statuses.resolved'),
                    ]),
                SelectFilter::make('priority')
                    ->options([
                        'low' => __('ticket::ticket.priorities.low'),
                        'medium' => __('ticket::ticket.priorities.medium'),
                        'high' => __('ticket::ticket.priorities.high'),
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                TicketActions::changeStatus(),
                TicketActions::addReply(),
                DeleteAction::make(),
            ])
            ->emptyStateHeading(__('ticket::ticket.labels.no_tickets'));
    }
}

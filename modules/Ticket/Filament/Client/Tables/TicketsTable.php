<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Client\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TicketsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('#')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('subject')
                    ->label(__('ticket::ticket.fields.subject'))
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                TextColumn::make('status')
                    ->label(__('ticket::ticket.fields.status'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'open' => 'info',
                        'in_progress' => 'warning',
                        'resolved' => 'success',
                        'closed' => 'gray',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => __("ticket::ticket.statuses.{$state}"))
                    ->sortable(),
                TextColumn::make('priority')
                    ->label(__('ticket::ticket.fields.priority'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'high' => 'danger',
                        'medium' => 'warning',
                        'low' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => __("ticket::ticket.labels.priority_{$state}"))
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label(__('dashboard.fields.created_at'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated([10, 25, 50]);
    }
}

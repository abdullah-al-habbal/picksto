<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Client\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class TicketInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('ticket::ticket.labels.singular'))
                    ->components([
                        TextEntry::make('subject')
                            ->label(__('ticket::ticket.fields.subject')),
                        TextEntry::make('status')
                            ->label(__('ticket::ticket.fields.status'))
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'open' => 'info',
                                'in_progress' => 'warning',
                                'resolved' => 'success',
                                'closed' => 'gray',
                                default => 'gray',
                            })
                            ->formatStateUsing(fn (string $state): string => __("ticket::ticket.statuses.{$state}")),
                        TextEntry::make('priority')
                            ->label(__('ticket::ticket.fields.priority'))
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'high' => 'danger',
                                'medium' => 'warning',
                                'low' => 'info',
                                default => 'gray',
                            })
                            ->formatStateUsing(fn (string $state): string => __("ticket::ticket.labels.priority_{$state}")),
                        TextEntry::make('created_at')
                            ->label(__('dashboard.fields.created_at'))
                            ->dateTime(),
                        TextEntry::make('message')
                            ->label(__('ticket::ticket.fields.message'))
                            ->html()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}

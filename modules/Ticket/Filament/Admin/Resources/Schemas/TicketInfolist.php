<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Admin\Resources\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

final class TicketInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name')
                    ->label(__('ticket::ticket.fields.user')),

                TextEntry::make('subject')
                    ->label(__('ticket::ticket.fields.subject')),

                TextEntry::make('status')
                    ->label(__('ticket::ticket.fields.status'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'open' => 'success',
                        'pending' => 'warning',
                        'closed' => 'gray',
                        'resolved' => 'primary',
                        default => 'gray',
                    }),

                TextEntry::make('priority')
                    ->label(__('ticket::ticket.fields.priority'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'high' => 'danger',
                        'medium' => 'warning',
                        'low' => 'success',
                        default => 'gray',
                    }),

                TextEntry::make('message')
                    ->label(__('ticket::ticket.fields.message'))
                    ->columnSpanFull(),

                TextEntry::make('created_at')
                    ->label(__('dashboard.fields.created_at'))
                    ->dateTime(),
            ]);
    }
}

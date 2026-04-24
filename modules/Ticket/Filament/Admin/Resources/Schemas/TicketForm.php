<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Admin\Resources\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

final class TicketForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label(__('ticket::ticket.fields.user'))
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),

                TextInput::make('subject')
                    ->label(__('ticket::ticket.fields.subject'))
                    ->required()
                    ->maxLength(255),

                Select::make('status')
                    ->label(__('ticket::ticket.fields.status'))
                    ->options([
                        'open' => __('ticket::ticket.statuses.open'),
                        'pending' => __('ticket::ticket.statuses.pending'),
                        'closed' => __('ticket::ticket.statuses.closed'),
                        'resolved' => __('ticket::ticket.statuses.resolved'),
                    ])
                    ->required(),

                Select::make('priority')
                    ->label(__('ticket::ticket.fields.priority'))
                    ->options([
                        'low' => __('ticket::ticket.priorities.low'),
                        'medium' => __('ticket::ticket.priorities.medium'),
                        'high' => __('ticket::ticket.priorities.high'),
                    ])
                    ->required(),

                Textarea::make('message')
                    ->label(__('ticket::ticket.fields.message'))
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}

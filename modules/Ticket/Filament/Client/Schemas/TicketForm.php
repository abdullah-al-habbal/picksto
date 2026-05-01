<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Client\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class TicketForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('subject')
                    ->label(__('ticket::ticket.fields.subject'))
                    ->required()
                    ->maxLength(255),
                Select::make('priority')
                    ->label(__('ticket::ticket.fields.priority'))
                    ->options([
                        'low' => __('ticket::ticket.labels.priority_low'),
                        'medium' => __('ticket::ticket.labels.priority_medium'),
                        'high' => __('ticket::ticket.labels.priority_high'),
                    ])
                    ->required()
                    ->native(false),
                RichEditor::make('message')
                    ->label(__('ticket::ticket.fields.message'))
                    ->required()
                    ->toolbarButtons(['bold', 'italic', 'underline', 'link']),
            ]);
    }
}

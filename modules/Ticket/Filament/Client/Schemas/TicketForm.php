<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Client\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TicketForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('New Support Ticket')
                    ->components([
                        TextInput::make('subject')
                            ->label('Subject')
                            ->required()
                            ->maxLength(255),
                        Select::make('category')
                            ->label('Category')
                            ->options([
                                'bug' => 'Bug Report',
                                'feature' => 'Feature Request',
                                'support' => 'Technical Support',
                                'billing' => 'Billing Question',
                                'other' => 'Other',
                            ])
                            ->required(),
                        RichEditor::make('description')
                            ->label('Description')
                            ->required()
                            ->toolbarButtons(['bold', 'italic', 'underline', 'link']),
                    ])
                    ->columns(1),
            ]);
    }
}

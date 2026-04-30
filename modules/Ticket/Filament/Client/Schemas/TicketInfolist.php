<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Client\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TicketInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Ticket Details')
                    ->components([
                        TextEntry::make('subject')
                            ->label('Subject'),
                        TextEntry::make('category')
                            ->label('Category')
                            ->badge(),
                        TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'open' => 'info',
                                'in_progress' => 'warning',
                                'resolved' => 'success',
                                'closed' => 'gray',
                                default => 'gray',
                            }),
                        TextEntry::make('priority')
                            ->label('Priority')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'high' => 'danger',
                                'medium' => 'warning',
                                'low' => 'info',
                                default => 'gray',
                            }),
                        TextEntry::make('description')
                            ->label('Description')
                            ->html()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}

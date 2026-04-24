<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Admin\Resources;

use Filament\Resources\Resource;
use Modules\Ticket\Filament\Admin\Resources\Pages\ListTickets;
use Modules\Ticket\Filament\Admin\Resources\Pages\ViewTicket;
use Modules\Ticket\Filament\Admin\Resources\Tables\TicketsTable;
use Modules\Ticket\Models\TicketModel;

final class TicketResource extends Resource
{
    protected static ?string $model = TicketModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.navigation.groups.support');
    }

    public static function getNavigationLabel(): string
    {
        return __('ticket::ticket.labels.tickets');
    }

    public static function table(\Filament\Tables\Table $table): \Filament\Tables\Table
    {
        return TicketsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTickets::route('/'),
            'view' => ViewTicket::route('/{record}'),
        ];
    }
}

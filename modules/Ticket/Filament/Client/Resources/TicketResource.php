<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Client\Resources;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\Ticket\Models\TicketModel;
use Modules\Ticket\Filament\Client\Resources\Pages\CreateTicket;
use Modules\Ticket\Filament\Client\Resources\Pages\ListTickets;
use Modules\Ticket\Filament\Client\Resources\Pages\ViewTicket;
use Modules\Ticket\Filament\Client\Schemas\TicketForm;
use Modules\Ticket\Filament\Client\Schemas\TicketInfolist;
use Modules\Ticket\Filament\Client\Tables\TicketsTable;

class TicketResource extends Resource
{
    protected static ?string $model = TicketModel::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-ticket';

    protected static ?int $navigationSort = 4;

    public static function getNavigationGroup(): ?string
    {
        // fix: translate, use the Client translate files
        return 'Support';
    }

    public static function getNavigationLabel(): string
    {
        return 'Support Tickets';
    }

    public static function form(Schema $schema): Schema
    {
        return TicketForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TicketInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TicketsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTickets::route('/'),
            'create' => CreateTicket::route('/create'),
            'view' => ViewTicket::route('/{record}'),
        ];
    }
}

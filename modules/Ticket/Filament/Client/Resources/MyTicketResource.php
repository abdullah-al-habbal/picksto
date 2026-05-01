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

final class MyTicketResource extends Resource
{
    protected static ?string $model = TicketModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?int $navigationSort = 4;

    public static function getNavigationLabel(): string
    {
        return __('ticket::ticket.labels.tickets');
    }

    public static function getModelLabel(): string
    {
        return __('ticket::ticket.labels.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('ticket::ticket.labels.plural');
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->id());
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

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.navigation.groups.support');
    }
}

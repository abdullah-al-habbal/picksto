<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Admin\Resources;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Modules\Ticket\Filament\Admin\Resources\Pages\ListTickets;
use Modules\Ticket\Filament\Admin\Resources\Pages\ViewTicket;
use Modules\Ticket\Filament\Admin\Resources\RelationManagers\RepliesRelationManager;
use Modules\Ticket\Filament\Admin\Resources\Schemas\TicketForm;
use Modules\Ticket\Filament\Admin\Resources\Schemas\TicketInfolist;
use Modules\Ticket\Filament\Admin\Resources\Tables\TicketsTable;
use Modules\Ticket\Models\TicketModel;

final class TicketResource extends Resource
{
    protected static ?string $model = TicketModel::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-ticket';

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.navigation.groups.support');
    }

    public static function getNavigationLabel(): string
    {
        return __('ticket::ticket.labels.tickets');
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

    public static function getRelations(): array
    {
        return [
            RepliesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTickets::route('/'),
            'view' => ViewTicket::route('/{record}'),
        ];
    }
}

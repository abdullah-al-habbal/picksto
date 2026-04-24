<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Admin\Resources\Pages;

use Filament\Resources\Pages\ListRecords;
use Modules\Ticket\Filament\Admin\Resources\TicketResource;

class ListTickets extends ListRecords
{
    protected static string $resource = TicketResource::class;
}

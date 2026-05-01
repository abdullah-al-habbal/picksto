<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Client\Resources\Pages;

use Filament\Resources\Pages\ListRecords;
use Modules\Ticket\Filament\Client\Resources\MyTicketResource;

class ListTickets extends ListRecords
{
    protected static string $resource = MyTicketResource::class;
}

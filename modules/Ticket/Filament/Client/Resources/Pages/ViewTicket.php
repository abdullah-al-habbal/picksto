<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Client\Resources\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\Ticket\Filament\Client\Resources\TicketResource;

class ViewTicket extends ViewRecord
{
    protected static string $resource = TicketResource::class;
}

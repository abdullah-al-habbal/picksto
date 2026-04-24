<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Admin\Resources\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\Ticket\Filament\Admin\Actions\TicketActions;
use Modules\Ticket\Filament\Admin\Resources\TicketResource;

class ViewTicket extends ViewRecord
{
    protected static string $resource = TicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            TicketActions::changeStatus(),
            TicketActions::addReply(),
        ];
    }
}

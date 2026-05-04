<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Client\Resources\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Ticket\Filament\Client\Resources\TicketResource;

class CreateTicket extends CreateRecord
{
    protected static string $resource = TicketResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        return $data;
    }
}

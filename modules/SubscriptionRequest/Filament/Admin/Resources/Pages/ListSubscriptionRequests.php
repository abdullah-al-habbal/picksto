<?php

declare(strict_types=1);

namespace Modules\SubscriptionRequest\Filament\Admin\Resources\Pages;

use Filament\Resources\Pages\ListRecords;
use Modules\SubscriptionRequest\Filament\Admin\Resources\SubscriptionRequestResource;

class ListSubscriptionRequests extends ListRecords
{
    protected static string $resource = SubscriptionRequestResource::class;
}

<?php

declare(strict_types=1);

namespace Modules\SubscriptionRequest\Filament\Client\Resources\Pages;

use Filament\Resources\Pages\ListRecords;
use Modules\SubscriptionRequest\Filament\Client\Resources\MySubscriptionRequestResource;

final class ListMySubscriptionRequests extends ListRecords
{
    protected static string $resource = MySubscriptionRequestResource::class;
}

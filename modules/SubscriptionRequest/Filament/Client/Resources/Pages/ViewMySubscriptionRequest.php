<?php

declare(strict_types=1);

namespace Modules\SubscriptionRequest\Filament\Client\Resources\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\SubscriptionRequest\Filament\Client\Resources\MySubscriptionRequestResource;

final class ViewMySubscriptionRequest extends ViewRecord
{
    protected static string $resource = MySubscriptionRequestResource::class;
}

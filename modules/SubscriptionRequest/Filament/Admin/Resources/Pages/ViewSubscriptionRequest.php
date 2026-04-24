<?php

declare(strict_types=1);

namespace Modules\SubscriptionRequest\Filament\Admin\Resources\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\SubscriptionRequest\Filament\Admin\Resources\SubscriptionRequestResource;

final class ViewSubscriptionRequest extends ViewRecord
{
    protected static string $resource = SubscriptionRequestResource::class;
}

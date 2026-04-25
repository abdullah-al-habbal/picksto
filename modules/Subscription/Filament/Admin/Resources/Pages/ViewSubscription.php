<?php

declare(strict_types=1);

namespace Modules\Subscription\Filament\Admin\Resources\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\Subscription\Filament\Admin\Resources\SubscriptionResource;

class ViewSubscription extends ViewRecord
{
    protected static string $resource = SubscriptionResource::class;
}

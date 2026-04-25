<?php

declare(strict_types=1);

namespace Modules\Subscription\Filament\Admin\Resources\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Subscription\Filament\Admin\Resources\SubscriptionResource;

class CreateSubscription extends CreateRecord
{
    protected static string $resource = SubscriptionResource::class;
}

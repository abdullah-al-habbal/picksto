<?php

declare(strict_types=1);

namespace Modules\SubscriptionRequest\Filament\Admin\Resources\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\SubscriptionRequest\Filament\Admin\Resources\SubscriptionRequestResource;

class CreateSubscriptionRequest extends CreateRecord
{
    protected static string $resource = SubscriptionRequestResource::class;
}

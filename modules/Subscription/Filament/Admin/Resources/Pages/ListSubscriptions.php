<?php

declare(strict_types=1);

namespace Modules\Subscription\Filament\Admin\Resources\Pages;

use Filament\Resources\Pages\ListRecords;
use Modules\Subscription\Filament\Admin\Resources\SubscriptionResource;

class ListSubscriptions extends ListRecords
{
    protected static string $resource = SubscriptionResource::class;
}

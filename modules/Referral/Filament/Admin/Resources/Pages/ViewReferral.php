<?php

declare(strict_types=1);

namespace Modules\Referral\Filament\Admin\Resources\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\Referral\Filament\Admin\Resources\ReferralResource;

class ViewReferral extends ViewRecord
{
    protected static string $resource = ReferralResource::class;
}

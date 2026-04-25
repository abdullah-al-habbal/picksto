<?php

declare(strict_types=1);

namespace Modules\Referral\Filament\Admin\Resources\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Referral\Filament\Admin\Resources\ReferralResource;

class CreateReferral extends CreateRecord
{
    protected static string $resource = ReferralResource::class;
}

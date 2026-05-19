<?php

declare(strict_types=1);

namespace Modules\Referral\Filament\Admin\Resources\Pages;

use Filament\Resources\Pages\EditRecord;
use Modules\Referral\Filament\Admin\Resources\ReferralRewardResource;

final class EditReferralReward extends EditRecord
{
    protected static string $resource = ReferralRewardResource::class;
}

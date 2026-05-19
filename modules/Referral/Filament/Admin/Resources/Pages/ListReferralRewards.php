<?php

declare(strict_types=1);

namespace Modules\Referral\Filament\Admin\Resources\Pages;

use Filament\Resources\Pages\ListRecords;
use Modules\Referral\Filament\Admin\Resources\ReferralRewardResource;

final class ListReferralRewards extends ListRecords
{
    protected static string $resource = ReferralRewardResource::class;
}

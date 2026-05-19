<?php

declare(strict_types=1);

namespace Modules\Referral\Filament\Admin\Resources\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\Referral\Filament\Admin\Resources\ReferralRewardResource;

final class ViewReferralReward extends ViewRecord
{
    protected static string $resource = ReferralRewardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

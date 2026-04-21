<?php

declare(strict_types=1);

namespace Modules\Referral\Presenters;

use Modules\Referral\Models\ReferralModel;
use Modules\Referral\Models\ReferralRewardModel;

final class ReferralPresenter
{
    public function presentReferral(ReferralModel $referral): array
    {
        return [
            'id' => $referral->id,
            'referrer' => [
                'id' => $referral->referrer?->id,
                'name' => $referral->referrer?->name,
                'email' => $referral->referrer?->email,
            ],
            'referred' => [
                'id' => $referral->referred?->id,
                'name' => $referral->referred?->name,
                'email' => $referral->referred?->email,
            ],
            'registeredAt' => $referral->registered_at?->format('Y-m-d H:i'),
        ];
    }

    public function presentReward(ReferralRewardModel $reward): array
    {
        return [
            'id' => $reward->id,
            'user' => [
                'id' => $reward->user?->id,
                'name' => $reward->user?->name,
                'email' => $reward->user?->email,
            ],
            'status' => $reward->status,
            'earnedAt' => $reward->earned_at?->format('Y-m-d H:i'),
            'expiresAt' => $reward->expires_at?->format('Y-m-d H:i'),
            'claimedAt' => $reward->claimed_at?->format('Y-m-d H:i'),
            'isExpired' => $reward->isExpired(),
        ];
    }
}

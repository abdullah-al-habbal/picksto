<?php

declare(strict_types=1);

namespace Modules\Referral\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Referral\Models\ReferralSettingModel;

final class ReferralSeeder extends Seeder
{
    public function run(): void
    {
        ReferralSettingModel::updateOrCreate(
            ['id' => 1],
            [
                'is_enabled' => true,
                'referrals_required' => 5,
                'reward_type' => 'subscription',
                'reward_duration' => 30,
                'reward_expiry_days' => 365,
                'welcome_message' => 'مرحباً بك في برنامج الإحالة!',
                'success_message' => 'لقد حصلت على مكافأة!',
            ]
        );
    }
}

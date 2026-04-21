<?php

declare(strict_types=1);

namespace Modules\Referral\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

final class ReferralSettingModelFactory extends Factory
{
    public function definition(): array
    {
        return [
            'is_enabled' => true,
            'referrals_required' => 5,
            'reward_type' => 'subscription',
            'reward_duration' => 30,
            'reward_expiry_days' => 365,
            'welcome_message' => 'Welcome to our referral program!',
            'success_message' => 'You have earned a reward!',
        ];
    }
}

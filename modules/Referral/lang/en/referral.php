<?php

declare(strict_types=1);

return [
    'validation' => [
        'rewardId' => [
            'required' => 'Reward ID is required',
        ],
        'referralsRequired' => [
            'min' => 'Referrals required must be at least 1',
        ],
        'rewardDuration' => [
            'min' => 'Reward duration must be at least 1 day',
        ],
    ],
    'messages' => [
        'reward_claimed' => 'Reward claimed successfully',
        'settings_updated' => 'Referral settings updated successfully',
    ],
    'errors' => [
        'invalid_code' => 'Invalid referral code',
        'claim_failed' => 'Failed to claim reward',
        'settings_update_failed' => 'Failed to update settings',
        'reward_expired' => 'This reward has expired',
    ],
    'labels' => [
        'referrer' => 'Referrer',
        'referred' => 'Referred',
        'status' => 'Status',
        'earned_at' => 'Earned At',
        'expires_at' => 'Expires At',
        'claimed_at' => 'Claimed At',
    ],
    'statuses' => [
        'pending' => 'Pending',
        'claimed' => 'Claimed',
        'expired' => 'Expired',
    ],
];

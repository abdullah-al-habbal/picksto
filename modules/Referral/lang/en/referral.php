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
    'settings' => [
        'title' => 'Referral Settings',
        'general' => 'Program Settings',
        'messages_section' => 'Messages',
        'is_enabled' => 'Program Enabled',
        'referrals_required' => 'Referrals Required for Reward',
        'reward_type' => 'Reward Type',
        'reward_duration' => 'Reward Duration (days)',
        'reward_expiry_days' => 'Reward Expiry (days)',
        'welcome_message' => 'Welcome Message',
        'success_message' => 'Success Message',
    ],
    'labels' => [
        'referrals' => 'Referrals',
        'rewards' => 'Rewards',
        'reward_singular' => 'Reward',
        'plural' => 'Referrals',
        'singular' => 'Referral',
        'referrer' => 'Referrer',
        'referred' => 'Referred User',
        'status' => 'Status',
        'earned_at' => 'Earned At',
        'expires_at' => 'Expires At',
        'claimed_at' => 'Claimed At',
    ],
    'fields' => [
        'user' => 'User',
        'referrer' => 'Referrer',
        'referred' => 'Referred User',
        'status' => 'Status',
        'earned_at' => 'Earned At',
        'expires_at' => 'Expires At',
        'claimed_at' => 'Claimed At',
        'registered_at' => 'Registered At',
    ],
    'statuses' => [
        'pending' => 'Pending',
        'claimed' => 'Claimed',
        'expired' => 'Expired',
    ],
];

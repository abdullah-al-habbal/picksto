<?php

declare(strict_types=1);

return [
    'validation' => [
        'rewardId' => [
            'required' => 'معرف المكافأة مطلوب',
        ],
        'referralsRequired' => [
            'min' => 'عدد الإحالات المطلوبة يجب أن يكون 1 على الأقل',
        ],
        'rewardDuration' => [
            'min' => 'مدة المكافأة يجب أن تكون يوم واحد على الأقل',
        ],
    ],
    'messages' => [
        'reward_claimed' => 'تم استلام المكافأة بنجاح',
        'settings_updated' => 'تم تحديث إعدادات الإحالة بنجاح',
    ],
    'errors' => [
        'invalid_code' => 'كود الإحالة غير صحيح',
        'claim_failed' => 'فشل استلام المكافأة',
        'settings_update_failed' => 'فشل تحديث الإعدادات',
        'reward_expired' => 'هذه المكافاة منتهية الصلاحية',
    ],
    'labels' => [
        'referrer' => 'المحيل',
        'referred' => 'المحال',
        'status' => 'الحالة',
        'earned_at' => 'تاريخ الاستحقاق',
        'expires_at' => 'تاريخ الانتهاء',
        'claimed_at' => 'تاريخ الاستلام',
    ],
    'statuses' => [
        'pending' => 'قيد الانتظار',
        'claimed' => 'تم الاستلام',
        'expired' => 'منتهي',
    ],
];

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
    'settings' => [
        'title' => 'إعدادات الإحالة',
        'general' => 'إعدادات البرنامج',
        'messages_section' => 'الرسائل',
        'is_enabled' => 'تفعيل البرنامج',
        'referrals_required' => 'عدد الإحالات المطلوبة للمكافأة',
        'reward_type' => 'نوع المكافأة',
        'reward_duration' => 'مدة المكافأة (أيام)',
        'reward_expiry_days' => 'انتهاء المكافأة (أيام)',
        'welcome_message' => 'رسالة الترحيب',
        'success_message' => 'رسالة النجاح',
    ],
    'labels' => [
        'referrals' => 'الإحالات',
        'rewards' => 'المكافآت',
        'reward_singular' => 'مكافأة',
        'plural' => 'الإحالات',
        'singular' => 'إحالة',
        'referrer' => 'المحيل',
        'referred' => 'المستخدم المحال',
        'status' => 'الحالة',
        'earned_at' => 'تاريخ الاستحقاق',
        'expires_at' => 'تاريخ الانتهاء',
        'claimed_at' => 'تاريخ الاستلام',
    ],
    'fields' => [
        'user' => 'المستخدم',
        'referrer' => 'المُحيل',
        'referred' => 'المُحال',
        'status' => 'الحالة',
        'earned_at' => 'تاريخ الاستحقاق',
        'expires_at' => 'تاريخ الانتهاء',
        'claimed_at' => 'تاريخ المطالبة',
        'registered_at' => 'تاريخ التسجيل',
    ],
    'statuses' => [
        'pending' => 'قيد الانتظار',
        'claimed' => 'تم الاستلام',
        'expired' => 'منتهي',
    ],
];

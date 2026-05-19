<?php

return [
    'navigation' => [
        'groups' => [
            'user_management' => 'إدارة المستخدمين',
            'subscriptions'   => 'الاشتراكات',
            'finance'         => 'المالية',
            'content'         => 'المحتوى',
            'configurations'  => 'التهيئات',
            'sales'           => 'المبيعات',
            'settings'        => 'الإعدادات',
            'referral'        => 'الإحالات',
            'support'         => 'الدعم الفني',
            'system'          => 'النظام',
            'account'         => 'الحساب',
            'growth'          => 'النمو',
            'billing'         => 'الفوترة',
        ],
    ],
    'actions' => [
        'save' => 'حفظ',
        'cancel' => 'إلغاء',
        'submit' => 'إرسال',
    ],
    'fields' => [
        'created_at' => 'تاريخ الإنشاء',
    ],
    'resources' => [
        'user' => [
            'navigation' => [
                'label' => 'المستخدمين',
                'plural' => 'المستخدمين',
                'singular' => 'مستخدم',
            ],
            'fields' => [
                'name' => 'الاسم',
                'email' => 'البريد الإلكتروني',
                'role' => 'الدور',
                'password' => 'كلمة المرور',
                'phone' => 'الهاتف',
                'status' => 'الحالة',
            ],
        ],
        'package' => [
            'navigation' => [
                'label' => 'الباقات',
                'plural' => 'الباقات',
                'singular' => 'باقة',
            ],
        ],
        'product' => [
            'navigation' => [
                'label' => 'المنتجات',
                'plural' => 'المنتجات',
                'singular' => 'منتج',
            ],
        ],
        'ticket' => [
            'navigation' => [
                'label' => 'التذاكر',
                'plural' => 'التذاكر',
                'singular' => 'تذكرة',
            ],
        ],
        'subscription' => [
            'navigation' => [
                'label' => 'الاشتراكات',
                'plural' => 'الاشتراكات',
                'singular' => 'اشتراك',
            ],
        ],
    ],
];

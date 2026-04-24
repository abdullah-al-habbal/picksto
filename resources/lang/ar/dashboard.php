<?php

return [
    'navigation' => [
        'groups' => [
            'user_management' => 'إدارة المستخدمين',
            'subscriptions'   => 'الاشتراكات',
            'finance'         => 'المالية',
            'content'         => 'المحتوى',
            'configurations'  => 'الإعدادات',
            'support'         => 'الدعم الفني',
            'system'          => 'النظام',
        ],
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

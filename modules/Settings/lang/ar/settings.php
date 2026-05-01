<?php

declare(strict_types=1);

return [
    'validation' => [
        'siteName' => [
            'max' => 'اسم الموقع يجب ألا يتجاوز 255 حرف',
        ],
        'logo' => [
            'url' => 'رابط الشعار يجب أن يكون رابط صحيح',
        ],
    ],
    'messages' => [
        'updated' => 'تم تحديث الإعدادات بنجاح',
    ],
    'errors' => [
        'update_failed' => 'فشل تحديث الإعدادات',
    ],
    'labels' => [
        'settings' => 'الإعدادات',
        'plural' => 'الإعدادات',
        'singular' => 'إعداد',
        'site_name' => 'اسم الموقع',
        'site_description' => 'وصف الموقع',
        'logo' => 'الشعار',
        'favicon' => 'الأيقونة',
        'botBrowserVisible' => 'إظهار متصفح البوت',
        'download_providers' => 'مزودو التنزيل',
        'notifications' => 'الإشعارات',
        'notification_preferences' => 'تفضيلات الإشعارات',
        'manage_notifications' => 'إدارة كيفية تلقي الإشعارات',
        'email_notifications' => 'إشعارات البريد الإلكتروني',
        'push_notifications' => 'إشعارات الجوال',
        'marketing_emails' => 'رسائل التسويق',
    ],
    'fields' => [
        'key' => 'المفتاح',
        'value' => 'القيمة',
        'group' => 'المجموعة',
    ],
];

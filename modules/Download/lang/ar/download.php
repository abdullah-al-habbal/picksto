<?php

declare(strict_types=1);

return [
    'validation' => [
        'url' => [
            'required' => 'رابط الملف مطلوب',
            'url' => 'صيغة الرابط غير صحيحة',
        ],
    ],
    'messages' => [
        'deleted' => 'تم حذف التنزيل بنجاح',
        'no_downloads' => 'لا توجد تنزيلات سابقة',
    ],
    'errors' => [
        'no_subscription' => 'لا يوجد اشتراك نشط',
        'site_not_supported' => 'باقتك لا تدعم التحميل من :site',
        'daily_limit_reached' => 'لقد وصلت للحد اليومي',
    ],
    'labels' => [
        'downloads' => 'التنزيلات',
        'plural' => 'التنزيلات',
        'singular' => 'تنزيل',
        'history' => 'سجل التنزيلات',
        'file_name' => 'اسم الملف',
        'site' => 'المصدر',
        'status' => 'الحالة',
        'date' => 'التاريخ',
        'actions' => 'إجراءات',
        'download' => 'تحميل',
    ],
    'fields' => [
        'user' => 'المستخدم',
        'file_name' => 'اسم الملف',
        'source_url' => 'رابط المصدر',
        'file_path' => 'مسار الملف',
        'site' => 'الموقع',
        'status' => 'الحالة',
        'ip_address' => 'عنوان IP',
    ],
    'statuses' => [
        'pending' => 'قيد التنفيذ',
        'completed' => 'مكتمل',
        'failed' => 'فشل',
    ],
];

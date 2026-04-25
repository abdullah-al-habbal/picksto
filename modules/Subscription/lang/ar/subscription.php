<?php

declare(strict_types=1);

return [
    'validation' => [
        'packageId' => [
            'required' => 'يرجى اختيار باقة للاشتراك',
            'exists' => 'الباقة المحددة غير موجودة',
            'inactive' => 'هذه الباقة غير متاحة حالياً',
        ],
    ],
    'messages' => [
        'purchase_success' => 'تم تفعيل اشتراكك بنجاح',
        'purchase_pending' => 'تم إرسال طلب اشتراكك، سيتم مراجعته قريباً',
        'already_pending' => 'لديك طلب اشتراك قيد المراجعة',
        'no_active_subscription' => 'لا يوجد اشتراك نشط',
        'download_limit_daily' => 'لقد وصلت للحد اليومي للتنزيلات (:limit)',
        'download_limit_monthly' => 'لقد وصلت للحد الشهري للتنزيلات (:limit)',
        'site_not_supported' => 'باقتك الحالية لا تدعم التحميل من :site',
    ],
    'errors' => [
        'purchase_failed' => 'فشل إتمام عملية الشراء، يرجى المحاولة لاحقاً',
        'package_not_found' => 'الباقة غير موجودة',
        'user_not_found' => 'المستخدم غير موجود',
    ],
    'labels' => [
        'subscriptions' => 'الاشتراكات',
        'plural' => 'الاشتراكات',
        'singular' => 'اشتراك',
        'package' => 'الباقة',
        'status' => 'الحالة',
        'status_active' => 'نشط',
        'status_pending' => 'قيد المراجعة',
        'status_expired' => 'منتهي',
        'status_cancelled' => 'ملغي',
        'start_date' => 'تاريخ البدء',
        'end_date' => 'تاريخ الانتهاء',
        'downloads_today' => 'تنزيلات اليوم',
        'downloads_month' => 'تنزيلات الشهر',
        'daily_limit' => 'الحد اليومي',
        'monthly_limit' => 'الحد الشهري',
        'remaining' => 'المتبقي',
        'payment_method' => 'طريقة الدفع',
        'transaction_id' => 'رقم المعاملة',
        'invoices' => 'الفواتير',
        'pending_subscriptions' => 'الاشتراكات المعلقة',
        'purchase_package' => 'شراء باقة',
        'renew_subscription' => 'تجديد الاشتراك',
    ],
    'fields' => [
        'user' => 'المستخدم',
        'package' => 'الباقة',
        'status' => 'الحالة',
        'start_date' => 'تاريخ البدء',
        'end_date' => 'تاريخ الانتهاء',
        'downloads_today' => 'تنزيلات اليوم',
        'downloads_month' => 'تنزيلات الشهر',
        'payment_method' => 'طريقة الدفع',
        'transaction_id' => 'رقم المعاملة',
    ],
    'statuses' => [
        'active' => 'نشط',
        'pending' => 'قيد المراجعة',
        'expired' => 'منتهي',
        'cancelled' => 'ملغي',
    ],
];

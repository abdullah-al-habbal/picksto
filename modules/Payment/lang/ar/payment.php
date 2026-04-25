<?php

declare(strict_types=1);

return [
    'validation' => [
        'packageId' => [
            'required' => 'يرجى اختيار الباقة',
            'exists' => 'الباقة المحددة غير موجودة',
        ],
        'gatewayId' => [
            'exists' => 'بوابة الدفع المحددة غير موجودة',
        ],
        'gateway' => [
            'name' => ['required' => 'اسم بوابة الدفع مطلوب'],
            'type' => [
                'required' => 'نوع بوابة الدفع مطلوب',
                'in' => 'نوع بوابة الدفع غير مدعوم',
            ],
        ],
    ],
    'messages' => [
        'request_submitted' => 'تم إرسال طلبك بنجاح، سيتم مراجعته قريباً',
        'gateway_created' => 'تم إضافة بوابة الدفع بنجاح',
        'gateway_updated' => 'تم تحديث بوابة الدفع بنجاح',
        'gateway_deleted' => 'تم حذف بوابة الدفع بنجاح',
        'request_approved' => 'تم تفعيل الاشتراك بنجاح',
        'request_rejected' => 'تم رفض الطلب',
    ],
    'errors' => [
        'request_failed' => 'فشل إرسال الطلب، يرجى المحاولة لاحقاً',
        'gateway_create_failed' => 'فشل إضافة بوابة الدفع',
        'gateway_update_failed' => 'فشل تحديث بوابة الدفع',
        'gateway_delete_failed' => 'فشل حذف بوابة الدفع',
        'request_approve_failed' => 'فشل تفعيل الاشتراك',
        'request_reject_failed' => 'فشل رفض الطلب',
    ],
    'labels' => [
        'gateways' => 'بوابات الدفع',
        'plural' => 'بوابات الدفع',
        'singular' => 'بوابة دفع',
        'gateway' => 'بوابة الدفع',
        'type' => 'النوع',
        'status' => 'الحالة',
        'amount' => 'المبلغ',
        'transaction_id' => 'رقم المعاملة',
        'user_notes' => 'ملاحظات المستخدم',
        'admin_notes' => 'ملاحظات الإدارة',
        'pending_requests' => 'الطلبات المعلقة',
        'payment_gateways' => 'بوابات الدفع',
        'request_subscription' => 'طلب اشتراك',
    ],
    'fields' => [
        'name' => 'الاسم',
        'type' => 'النوع',
        'status' => 'الحالة',
        'is_active' => 'نشط',
        'description' => 'الوصف',
        'config' => 'الإعدادات',
    ],
    'types' => [
        'stripe' => 'Stripe',
        'paypal' => 'PayPal',
        'manual' => 'دفع يدوي',
        'lemonsqueezy' => 'Lemon Squeezy',
    ],
    'statuses' => [
        'pending' => 'قيد المراجعة',
        'approved' => 'معتمد',
        'rejected' => 'مرفوض',
        'completed' => 'مكتمل',
    ],
];

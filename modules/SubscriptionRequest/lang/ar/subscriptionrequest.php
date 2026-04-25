<?php

declare(strict_types=1);

return [
    'actions' => [
        'approve' => 'موافقة',
        'reject' => 'رفض',
    ],
    'fields' => [
        'user' => 'المستخدم',
        'package' => 'الحزمة',
        'gateway' => 'بوابة الدفع',
        'amount' => 'المبلغ',
        'status' => 'الحالة',
        'transaction_id' => 'رقم العملية',
        'user_notes' => 'ملاحظات المستخدم',
        'admin_notes' => 'ملاحظات المسؤول',
        'approved_by' => 'تمت الموافقة بواسطة',
        'approved_at' => 'تاريخ الموافقة',
    ],
    'statuses' => [
        'pending' => 'قيد الانتظار',
        'approved' => 'تمت الموافقة',
        'rejected' => 'مرفوض',
        'completed' => 'مكتمل',
    ],
    'messages' => [
        'request_approved' => 'تمت الموافقة على طلب الاشتراك.',
        'request_rejected' => 'تم رفض طلب الاشتراك.',
    ],
    'labels' => [
        'requests' => 'طلبات الاشتراك',
        'plural' => 'طلبات الاشتراك',
        'singular' => 'طلب اشتراك',
        'no_requests' => 'لا توجد طلبات اشتراك حالياً',
    ],
];

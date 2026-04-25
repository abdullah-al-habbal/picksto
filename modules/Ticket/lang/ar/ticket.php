<?php

// Ticket/lang/ar/ticket.php

declare(strict_types=1);

return [
    'validation' => [
        'subject' => ['required' => 'عذرًا، يرجى إدخال موضوع التذكرة'],
        'message' => ['required' => 'عذرًا، يرجى إدخال نص التذكرة'],
        'reply' => ['required' => 'عذرًا، يرجى إدخال نص الرد'],
    ],
    'messages' => [
        'created' => 'تم إنشاء التذكرة بنجاح',
        'reply_added' => 'تم إضافة الرد بنجاح',
        'status_updated' => 'تم تحديث حالة التذكرة',
        'deleted' => 'تم حذف التذكرة بنجاح',
    ],
    'errors' => [
        'create_failed' => 'فشل إنشاء التذكرة، يرجى المحاولة لاحقاً',
        'reply_failed' => 'فشل إضافة الرد، يرجى المحاولة لاحقاً',
        'status_update_failed' => 'فشل تحديث الحالة',
        'delete_failed' => 'فشل حذف التذكرة',
    ],
    'actions' => [
        'change_status' => 'تغيير الحالة',
        'add_reply' => 'إضافة رد',
        'reply_to_ticket' => 'رد على التذكرة رقم :id',
    ],
    'fields' => [
        'status' => 'الحالة',
        'reply' => 'الرد',
        'user' => 'المستخدم',
        'subject' => 'الموضوع',
        'priority' => 'الأولوية',
    ],
    'statuses' => [
        'open' => 'مفتوحة',
        'in_progress' => 'قيد المعالجة',
        'closed' => 'مغلقة',
        'resolved' => 'تم الحل',
    ],
    'labels' => [
        'tickets' => 'التذاكر',
        'plural' => 'التذاكر',
        'singular' => 'تذكرة',
        'no_tickets' => 'لا توجد تذاكر حالياً',
        'status_open' => 'مفتوحة',
        'status_pending' => 'قيد المراجعة',
        'status_closed' => 'مغلقة',
        'status_resolved' => 'محلول',
        'priority_low' => 'منخفض',
        'priority_medium' => 'متوسط',
        'priority_high' => 'عالي',
    ],
];

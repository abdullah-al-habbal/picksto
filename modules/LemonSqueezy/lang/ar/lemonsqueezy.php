<?php

return [
    'navigation' => [
        'group' => 'الدفع',
    ],
    'customers' => [
        'labels' => [
            'singular' => 'عميل',
            'plural' => 'العملاء',
            'navigation' => 'عملاء LemonSqueezy',
        ],
        'fields' => [
            'id' => 'المعرف',
            'email' => 'البريد الإلكتروني',
            'name' => 'الاسم',
            'status' => 'الحالة',
            'created_at' => 'تاريخ الإنشاء',
        ],
        'status' => [
            'active' => 'نشط',
            'inactive' => 'غير نشط',
        ],
        'messages' => [
            'info' => 'هذه واجهة عرض فقط لعملاء LemonSqueezy. يتم جلب البيانات من واجهة برمجة تطبيقات LemonSqueezy.',
        ],
    ],
    'products' => [
        'labels' => [
            'singular' => 'منتج',
            'plural' => 'المنتجات',
            'navigation' => 'منتجات LemonSqueezy',
        ],
        'fields' => [
            'id' => 'المعرف',
            'name' => 'الاسم',
            'status' => 'الحالة',
            'created_at' => 'تاريخ الإنشاء',
        ],
        'status' => [
            'published' => 'منشور',
            'draft' => 'مسودة',
        ],
        'messages' => [
            'info' => 'هذه واجهة عرض فقط لمنتجات LemonSqueezy. يتم جلب البيانات من واجهة برمجة تطبيقات LemonSqueezy.',
        ],
    ],
];

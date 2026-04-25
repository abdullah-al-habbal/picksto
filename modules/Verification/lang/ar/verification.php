<?php

declare(strict_types=1);

return [
    'validation' => [
        'code' => [
            'required' => 'رمز التحقق مطلوب',
            'size' => 'رمز التحقق يجب أن يتكون من 6 أرقام',
        ],
        'type' => [
            'required' => 'نوع التحقق مطلوب',
        ],
    ],
    'messages' => [
        'code_sent_email' => 'تم إرسال رمز التحقق إلى بريدك الإلكتروني',
        'code_sent_whatsapp' => 'تم إرسال رمز التحقق إلى واتساب',
        'verified' => 'تم التحقق بنجاح',
        'settings_updated' => 'تم تحديث إعدادات التحقق بنجاح',
        'test_email_sent' => 'تم إرسال رسالة اختبار إلى :email',
        'test_whatsapp_sent' => 'تم إرسال رسالة اختبار إلى :phone',
    ],
    'errors' => [
        'email_disabled' => 'التحقق عبر البريد الإلكتروني معطل',
        'whatsapp_disabled' => 'التحقق عبر واتساب معطل',
        'no_email' => 'لا يوجد بريد إلكتروني مسجل',
        'no_phone' => 'لا يوجد رقم هاتف مسجل',
        'invalid_code' => 'رمز التحقق غير صحيح',
        'code_expired' => 'انتهت صلاحية رمز التحقق',
        'test_email_required' => 'يرجى إدخال بريد إلكتروني للاختبار',
        'test_phone_required' => 'يرجى إدخال رقم هاتف للاختبار',
    ],
    'labels' => [
        'codes' => 'رموز التحقق',
        'plural' => 'رموز التحقق',
        'singular' => 'رمز تحقق',
        'status' => 'الحالة',
        'type' => 'النوع',
    ],
    'fields' => [
        'user' => 'المستخدم',
        'type' => 'النوع',
        'code' => 'الرمز',
        'status' => 'الحالة',
        'expires_at' => 'تاريخ الانتهاء',
        'verified_at' => 'تاريخ التحقق',
    ],
    'types' => [
        'email' => 'بريد إلكتروني',
        'whatsapp' => 'واتساب',
    ],
    'statuses' => [
        'pending' => 'قيد الانتظار',
        'verified' => 'تم التحقق',
        'expired' => 'منتهي',
    ],
];

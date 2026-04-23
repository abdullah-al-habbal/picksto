<?php

declare(strict_types=1);

return [
    'validation' => [
        'provider' => [
            'required' => 'بيانات المزود مطلوبة',
        ],
        'testUrl' => [
            'required' => 'رابط الاختبار مطلوب',
            'url' => 'صيغة رابط الاختبار غير صحيحة',
        ],
    ],
    'messages' => [
        'test_success' => 'تم الاختبار بنجاح! الرابط: :link...',
        'custom_test_success' => 'تم تنفيذ :steps خطوة بنجاح!',
    ],
    'errors' => [
        'microservice_failed' => 'فشل الاتصال بخدمة البوت: [:status] :body',
        'no_custom_steps' => 'لا توجد خطوات مبرمجة. يرجى برمجة البوت أولاً.',
        'test_failed' => 'فشل الاختبار: :message',
    ],
    'labels' => [
        'provider' => 'المزود',
        'test_url' => 'رابط الاختبار',
        'downloader_type' => 'نوع البوت',
        'duration' => 'المدة',
        'download_link' => 'رابط التحميل',
    ],
];

<?php

// modules/LemonSqueezy/lang/ar/lemonsqueezy.php

declare(strict_types=1);

return [
    'validation' => [
        'variantId' => [
            'required' => 'معرف الباقة مطلوب',
        ],
    ],
    'messages' => [
        'checkout_created' => 'تم إنشاء رابط الدفع بنجاح',
        'webhook_received' => 'تم استلام الحدث بنجاح',
    ],
    'errors' => [
        'checkout_failed' => 'فشل إنشاء رابط الدفع، يرجى المحاولة لاحقاً',
        'fetch_failed' => 'فشل جلب البيانات من Lemon Squeezy',
    ],
    'labels' => [
        'products' => 'المنتجات',
        'customers' => 'العملاء',
        'subscriptions' => 'الاشتراكات',
        'checkout' => 'إتمام الشراء',
    ],
];

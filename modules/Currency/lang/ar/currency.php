<?php

// Currency/lang/ar/currency.php

declare(strict_types=1);

return [
    'validation' => [
        'code' => [
            'size' => 'رمز العملة يجب أن يتكون من 3 أحرف',
        ],
        'decimalSeparator' => [
            'size' => 'فاصل الكسور يجب أن يكون حرف واحد',
        ],
    ],
    'messages' => [
        'updated' => 'تم تحديث إعدادات العملة بنجاح',
    ],
    'errors' => [
        'update_failed' => 'فشل تحديث إعدادات العملة',
    ],
    'labels' => [
        'code' => 'رمز العملة',
        'symbol' => 'الرمز',
        'name' => 'اسم العملة',
        'decimalPlaces' => 'عدد الكسور',
        'decimalSeparator' => 'فاصل الكسور',
        'thousandsSeparator' => 'فاصل الآلاف',
        'symbolPosition' => 'موضع الرمز',
        'spaceBetween' => 'مسافة بين الرمز والرقم',
        'before' => 'قبل',
        'after' => 'بعد',
    ],
];

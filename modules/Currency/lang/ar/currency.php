<?php

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
        'currencies' => 'العملات',
        'plural' => 'العملات',
        'singular' => 'عملة',
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
    'fields' => [
        'code' => 'الرمز الدولي',
        'symbol' => 'الرمز',
        'name' => 'الاسم',
        'decimal_places' => 'عدد الكسور',
        'decimal_separator' => 'فاصل الكسور',
        'thousands_separator' => 'فاصل الآلاف',
        'symbol_position' => 'موضع الرمز',
        'space_between' => 'مسافة بين الرمز والرقم',
        'is_active' => 'نشط',
    ],
];

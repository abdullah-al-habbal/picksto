<?php

// Product/lang/ar/product.php

declare(strict_types=1);

return [
    'validation' => [
        'name_ar' => [
            'required' => 'اسم المنتج بالعربية مطلوب',
        ],
        'price' => [
            'required' => 'السعر مطلوب',
            'numeric' => 'السعر يجب أن يكون رقماً',
        ],
    ],
    'messages' => [
        'created' => 'تم إنشاء المنتج بنجاح',
        'updated' => 'تم تحديث المنتج بنجاح',
        'deleted' => 'تم حذف المنتج بنجاح',
    ],
    'errors' => [
        'create_failed' => 'فشل إنشاء المنتج',
        'update_failed' => 'فشل تحديث المنتج',
        'delete_failed' => 'فشل حذف المنتج',
    ],
];

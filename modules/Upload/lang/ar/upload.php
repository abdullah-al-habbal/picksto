<?php

declare(strict_types=1);

return [
    'validation' => [
        'file' => [
            'required' => 'يرجى اختيار ملف',
            'image' => 'الملف يجب أن يكون صورة',
            'max' => 'حجم الصورة يجب ألا يتجاوز 5 ميجابايت',
        ],
        'folder' => [
            'required' => 'المجلد مطلوب',
            'in' => 'المجلد غير صالح',
        ],
        'filename' => [
            'required' => 'اسم الملف مطلوب',
            'regex' => 'اسم الملف غير صالح',
        ],
    ],
    'messages' => [
        'logo_uploaded' => 'تم رفع الشعار بنجاح',
        'favicon_uploaded' => 'تم رفع الأيقونة بنجاح',
        'product_uploaded' => 'تم رفع صورة المنتج بنجاح',
        'avatar_uploaded' => 'تم رفع الصورة الشخصية بنجاح',
        'file_deleted' => 'تم حذف الملف بنجاح',
    ],
    'errors' => [
        'invalid_folder' => 'مجلد غير صالح',
        'file_not_found' => 'الملف غير موجود',
    ],
];

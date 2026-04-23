<?php

// modules/Package/lang/ar/package.php

declare(strict_types=1);

return [
    'validation' => [
        'name.ar' => [
            'required' => 'اسم الباقة بالعربية مطلوب',
            'sometimes' => 'اسم الباقة بالعربية غير صالح',
        ],
        'price' => [
            'required' => 'السعر مطلوب',
            'numeric' => 'السعر يجب أن يكون رقماً',
            'min' => 'السعر يجب أن يكون 0 أو أكثر',
        ],
        'currency' => [
            'in' => 'العملة غير مدعومة',
        ],
        'allowed_sites' => [
            'required' => 'يجب تحديد المواقع المسموح بها',
            'array' => 'المواقع المسموح بها يجب أن تكون مصفوفة',
        ],
        'duration_days' => [
            'required' => 'مدة الباقة مطلوبة',
            'min' => 'المدة يجب أن تكون يوم واحد على الأقل',
        ],
    ],
    'messages' => [
        'created' => 'تم إنشاء الباقة بنجاح',
        'updated' => 'تم تحديث الباقة بنجاح',
        'deleted' => 'تم حذف الباقة بنجاح',
        'no_packages' => 'لا توجد باقات متاحة حالياً',
    ],
    'errors' => [
        'create_failed' => 'فشل إنشاء الباقة، يرجى المحاولة لاحقاً',
        'update_failed' => 'فشل تحديث الباقة، يرجى المحاولة لاحقاً',
        'delete_failed' => 'فشل حذف الباقة، يرجى المحاولة لاحقاً',
        'not_found' => 'الباقة غير موجودة',
    ],
    'labels' => [
        'name.ar' => 'اسم الباقة (عربي)',
        'name.en' => 'اسم الباقة (إنجليزي)',
        'description.ar' => 'الوصف (عربي)',
        'description.en' => 'الوصف (إنجليزي)',
        'price' => 'السعر',
        'currency' => 'العملة',
        'daily_limit' => 'الحد اليومي للتنزيلات',
        'monthly_limit' => 'الحد الشهري للتنزيلات',
        'allowed_sites' => 'المواقع المسموح بها',
        'duration_days' => 'مدة الباقة (أيام)',
        'days' => 'يوم|أيام',
        'is_active' => 'نشط',
        'create_package' => 'إنشاء باقة جديدة',
        'edit_package' => 'تعديل الباقة',
        'delete_package' => 'حذف الباقة',
        'packages' => 'الباقات',
    ],
    'sites' => [
        'Freepik' => 'Freepik',
        'Flaticon' => 'Flaticon',
        'EnvatoElements' => 'Envato Elements',
        'MotionArray' => 'MotionArray',
        'Shutterstock' => 'Shutterstock',
        'AdobeStock' => 'AdobeStock',
        'Artlist' => 'Artlist',
        'Pikbest' => 'Pikbest',
        'Placeit' => 'Placeit',
        'All' => 'جميع المواقع',
    ],
];

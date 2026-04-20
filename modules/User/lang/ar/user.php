<?php
// modules/User/lang/ar/user.php

declare(strict_types=1);

return [
    'validation' => [
        'name' => [
            'required' => 'يرجى إدخال الاسم',
            'min' => 'الاسم يجب أن يكون حرفين على الأقل',
        ],
        'email' => [
            'email' => 'صيغة البريد الإلكتروني غير صحيحة',
            'unique' => 'هذا البريد الإلكتروني مسجل مسبقاً',
        ],
        'phone' => [
            'regex' => 'رقم الهاتف غير صحيح. يجب أن يبدأ بمفتاح الدولة مثل +966',
        ],
        'avatar' => [
            'required' => 'يرجى اختيار صورة',
            'image' => 'الملف يجب أن يكون صورة',
            'max' => 'حجم الصورة لا يجب أن يتجاوز 5 ميجابايت',
        ],
    ],
    'messages' => [
        'profile_updated' => 'تم تحديث بياناتك الشخصية بنجاح',
        'avatar_uploaded' => 'تم رفع الصورة الشخصية بنجاح',
        'role_updated' => 'تم تغيير دور المستخدم بنجاح',
        'user_banned' => 'تم حظر المستخدم',
        'user_unbanned' => 'تم إلغاء حظر المستخدم',
        'package_activated' => 'تم تفعيل الحزمة لمدة :days يوم',
        'account_banned' => 'هذا الحساب محظور، يرجى التواصل مع الدعم',
    ],
    'errors' => [
        'profile_update_failed' => 'فشل تحديث البيانات، يرجى المحاولة لاحقاً',
        'avatar_upload_failed' => 'فشل رفع الصورة، يرجى المحاولة لاحقاً',
        'user_not_found' => 'المستخدم غير موجود',
    ],
    'labels' => [
        'name' => 'الاسم الكامل',
        'email' => 'البريد الإلكتروني',
        'phone' => 'رقم الهاتف',
        'profession' => 'المهنة',
        'companySize' => 'حجم الشركة',
        'role' => 'الدور',
        'status' => 'الحالة',
        'avatar' => 'الصورة الشخصية',
        'profile' => 'الملف الشخصي',
        'edit_profile' => 'تعديل الملف الشخصي',
        'save_changes' => 'حفظ التغييرات',
    ],
];

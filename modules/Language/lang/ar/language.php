<?php

return [
    'validation' => [
        'name' => ['required' => 'اسم اللغة مطلوب', 'max' => 'اسم اللغة طويل جدًا'],
        'code' => ['required' => 'رمز اللغة مطلوب', 'unique' => 'رمز اللغة موجود بالفعل'],
    ],
    'messages' => [
        'created' => 'تم إنشاء اللغة بنجاح',
        'updated' => 'تم تحديث اللغة بنجاح',
        'deleted' => 'تم حذف اللغة بنجاح',
    ],
    'labels' => [
        'languages' => 'اللغات',
        'plural' => 'اللغات',
        'singular' => 'لغة',
        'name' => 'اسم اللغة',
        'code' => 'رمز اللغة',
        'is_active' => 'نشط',
        'is_default' => 'افتراضي',
        'is_rtl' => 'من اليمين لليسار',
    ],
    'fields' => [
        'name' => 'الاسم',
        'code' => 'الرمز',
        'is_active' => 'نشط',
        'is_default' => 'افتراضي',
        'is_rtl' => 'RTL',
    ],
];

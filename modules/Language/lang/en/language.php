<?php

return [
    'validation' => [
        'name' => ['required' => 'Language name is required', 'max' => 'Language name is too long'],
        'code' => ['required' => 'Language code is required', 'unique' => 'Language code already exists'],
    ],
    'messages' => [
        'created' => 'Language created successfully',
        'updated' => 'Language updated successfully',
        'deleted' => 'Language deleted successfully',
    ],
    'labels' => [
        'languages' => 'Languages',
        'plural' => 'Languages',
        'singular' => 'Language',
        'name' => 'Language Name',
        'code' => 'Language Code',
        'is_active' => 'Active',
        'is_default' => 'Default',
        'is_rtl' => 'RTL',
    ],
    'fields' => [
        'name' => 'Name',
        'code' => 'Code',
        'is_active' => 'Active',
        'is_default' => 'Default',
        'is_rtl' => 'RTL',
    ],
];

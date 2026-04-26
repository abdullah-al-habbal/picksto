<?php

declare(strict_types=1);

return [
    'validation' => [
        'name.ar' => [
            'required' => 'Package name in Arabic is required',
            'sometimes' => 'Package name in Arabic is invalid',
        ],
        'price' => [
            'required' => 'Price is required',
            'numeric' => 'Price must be a number',
            'min' => 'Price must be 0 or more',
        ],
        'currency' => [
            'in' => 'Currency not supported',
        ],
        'allowed_sites' => [
            'required' => 'Allowed sites must be specified',
            'array' => 'Allowed sites must be an array',
        ],
        'duration_days' => [
            'required' => 'Package duration is required',
            'min' => 'Duration must be at least 1 day',
        ],
    ],
    'messages' => [
        'created' => 'Package created successfully',
        'updated' => 'Package updated successfully',
        'deleted' => 'Package deleted successfully',
        'no_packages' => 'No packages available at the moment',
    ],
    'errors' => [
        'create_failed' => 'Failed to create package, please try again',
        'update_failed' => 'Failed to update package, please try again',
        'delete_failed' => 'Failed to delete package, please try again',
        'not_found' => 'Package not found',
    ],
    'labels' => [
        'packages' => 'Packages',
        'plural' => 'Packages',
        'singular' => 'Package',
        'name.ar' => 'Package Name (Arabic)',
        'name.en' => 'Package Name (English)',
        'description.ar' => 'Description (Arabic)',
        'description.en' => 'Description (English)',
        'price' => 'Price',
        'currency' => 'Currency',
        'daily_limit' => 'Daily Download Limit',
        'monthly_limit' => 'Monthly Download Limit',
        'allowed_sites' => 'Allowed Sites',
        'duration_days' => 'Duration (Days)',
        'days' => 'day|days',
        'is_active' => 'Active',
        'create_package' => 'Create New Package',
        'edit_package' => 'Edit Package',
        'delete_package' => 'Delete Package',
    ],
    'fields' => [
        'name' => 'Name',
        'price' => 'Price',
        'currency' => 'Currency',
        'daily_limit' => 'Daily Limit',
        'monthly_limit' => 'Monthly Limit',
        'allowed_sites' => 'Allowed Sites',
        'duration_days' => 'Duration (Days)',
        'is_active' => 'Active',
        'description' => 'Description',
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
        'All' => 'All Sites',
    ],
];

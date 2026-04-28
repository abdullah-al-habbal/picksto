<?php

return [
    'navigation' => [
        'group' => 'Payment',
    ],
    'customers' => [
        'labels' => [
            'singular' => 'Customer',
            'plural' => 'Customers',
            'navigation' => 'LemonSqueezy Customers',
        ],
        'fields' => [
            'id' => 'ID',
            'email' => 'Email',
            'name' => 'Name',
            'status' => 'Status',
            'created_at' => 'Created At',
        ],
        'status' => [
            'active' => 'Active',
            'inactive' => 'Inactive',
        ],
        'messages' => [
            'info' => 'This is a read-only view of LemonSqueezy customers. Data is fetched from the LemonSqueezy API.',
        ],
    ],
    'products' => [
        'labels' => [
            'singular' => 'Product',
            'plural' => 'Products',
            'navigation' => 'LemonSqueezy Products',
        ],
        'fields' => [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            'created_at' => 'Created At',
        ],
        'status' => [
            'published' => 'Published',
            'draft' => 'Draft',
        ],
        'messages' => [
            'info' => 'This is a read-only view of LemonSqueezy products. Data is fetched from the LemonSqueezy API.',
        ],
    ],
];

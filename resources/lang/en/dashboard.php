<?php

return [
    'navigation' => [
        'groups' => [
            'user_management' => 'User Management',
            'subscriptions' => 'Subscriptions',
            'finance' => 'Finance',
            'content' => 'Content',
            'configurations' => 'Configurations',
            'support' => 'Support',
            'system' => 'System',
        ],
    ],
    'resources' => [
        'user' => [
            'navigation' => [
                'label' => 'Users',
                'plural' => 'Users',
                'singular' => 'User',
            ],
            'fields' => [
                'name' => 'Name',
                'email' => 'Email',
                'role' => 'Role',
                'password' => 'Password',
                'phone' => 'Phone',
                'status' => 'Status',
                'is_banned' => 'Is Banned',
                'email_verified' => 'Email Verified',
                'phone_verified' => 'Phone Verified',
                'avatar' => 'Avatar',
                'referral_code' => 'Referral Code',
                'profession' => 'Profession',
                'company_size' => 'Company Size',
                'last_login_at' => 'Last Login At',
                'verified' => 'Verified',
                'unverified' => 'Unverified',
                'banned' => 'Banned',
                'active' => 'Active',
            ],
        ],
        'package' => [
            'navigation' => [
                'label' => 'Packages',
                'plural' => 'Packages',
                'singular' => 'Package',
            ],
        ],
        'product' => [
            'navigation' => [
                'label' => 'Products',
                'plural' => 'Products',
                'singular' => 'Product',
            ],
        ],
        'ticket' => [
            'navigation' => [
                'label' => 'Tickets',
                'plural' => 'Tickets',
                'singular' => 'Ticket',
            ],
        ],
        'subscription' => [
            'navigation' => [
                'label' => 'Subscriptions',
                'plural' => 'Subscriptions',
                'singular' => 'Subscription',
            ],
        ],
    ],
];

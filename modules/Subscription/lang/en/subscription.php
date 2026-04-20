<?php
// modules/Subscription/lang/en/subscription.php

declare(strict_types=1);

return [
    'validation' => [
        'packageId' => [
            'required' => 'Please select a package to subscribe',
            'exists' => 'Selected package does not exist',
            'inactive' => 'This package is currently unavailable',
        ],
    ],
    'messages' => [
        'purchase_success' => 'Your subscription has been activated successfully',
        'purchase_pending' => 'Your subscription request has been submitted and will be reviewed soon',
        'already_pending' => 'You have a pending subscription request',
        'no_active_subscription' => 'No active subscription found',
        'download_limit_daily' => 'You have reached your daily download limit (:limit)',
        'download_limit_monthly' => 'You have reached your monthly download limit (:limit)',
        'site_not_supported' => 'Your current package does not support downloads from :site',
    ],
    'errors' => [
        'purchase_failed' => 'Failed to complete purchase, please try again later',
        'package_not_found' => 'Package not found',
        'user_not_found' => 'User not found',
    ],
    'labels' => [
        'package' => 'Package',
        'status' => 'Status',
        'status_active' => 'Active',
        'status_pending' => 'Pending',
        'status_expired' => 'Expired',
        'status_cancelled' => 'Cancelled',
        'start_date' => 'Start Date',
        'end_date' => 'End Date',
        'downloads_today' => 'Downloads Today',
        'downloads_month' => 'Downloads This Month',
        'daily_limit' => 'Daily Limit',
        'monthly_limit' => 'Monthly Limit',
        'remaining' => 'Remaining',
        'payment_method' => 'Payment Method',
        'transaction_id' => 'Transaction ID',
        'invoices' => 'Invoices',
        'pending_subscriptions' => 'Pending Subscriptions',
        'purchase_package' => 'Purchase Package',
        'renew_subscription' => 'Renew Subscription',
    ],
    'statuses' => [
        'active' => '🟢 Active',
        'pending' => '🟡 Pending',
        'expired' => '🔴 Expired',
        'cancelled' => '⚪ Cancelled',
    ],
];

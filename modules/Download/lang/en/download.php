<?php
// modules/Download/lang/en/download.php

declare(strict_types=1);

return [
    'validation' => [
        'url' => [
            'required' => 'Download URL is required',
            'url' => 'Invalid URL format',
        ],
    ],
    'messages' => [
        'deleted' => 'Download deleted successfully',
        'no_downloads' => 'No previous downloads',
    ],
    'errors' => [
        'no_subscription' => 'No active subscription',
        'site_not_supported' => 'Your package does not support downloads from :site',
        'daily_limit_reached' => 'Daily download limit reached',
    ],
    'labels' => [
        'history' => 'Download History',
        'file_name' => 'File Name',
        'site' => 'Source',
        'status' => 'Status',
        'date' => 'Date',
        'actions' => 'Actions',
        'download' => 'Download',
    ],
];

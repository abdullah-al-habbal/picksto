<?php

declare(strict_types=1);

return [
    'validation' => [
        'siteName' => [
            'max' => 'Site name must not exceed 255 characters',
        ],
        'logo' => [
            'url' => 'Logo URL must be a valid URL',
        ],
    ],
    'messages' => [
        'updated' => 'Settings updated successfully',
    ],
    'errors' => [
        'update_failed' => 'Failed to update settings',
    ],
    'labels' => [
        'settings' => 'Settings',
        'plural' => 'Settings',
        'singular' => 'Setting',
        'site_name' => 'Site Name',
        'site_description' => 'Site Description',
        'logo' => 'Logo',
        'favicon' => 'Favicon',
        'botBrowserVisible' => 'Show Bot Browser',
        'download_providers' => 'Download Providers',
    ],
    'fields' => [
        'key' => 'Key',
        'value' => 'Value',
        'group' => 'Group',
    ],
];

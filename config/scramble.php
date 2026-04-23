<?php

// config/scramble.php
use Dedoc\Scramble\Http\Middleware\RestrictedDocsAccess;

return [
    'api_path' => 'api/v1',
    'api_domain' => null,
    'info' => [
        'version' => env('API_VERSION', '1.0.0'),
        'description' => 'picksto API Documentation',
    ],
    'servers' => null,
    'middleware' => [
        'web',
        RestrictedDocsAccess::class,
    ],
    'extensions' => [],
];

<?php

declare(strict_types=1);

return [
    'validation' => [
        'provider' => [
            'required' => 'Provider data is required',
        ],
        'testUrl' => [
            'required' => 'Test URL is required',
            'url' => 'Invalid test URL format',
        ],
    ],
    'messages' => [
        'test_success' => 'Test completed successfully! Link: :link...',
        'custom_test_success' => 'Executed :steps steps successfully!',
    ],
    'errors' => [
        'microservice_failed' => 'Failed to connect to bot service: [:status] :body',
        'no_custom_steps' => 'No custom steps defined. Please program the bot first.',
        'test_failed' => 'Test failed: :message',
    ],
    'labels' => [
        'provider' => 'Provider',
        'test_url' => 'Test URL',
        'downloader_type' => 'Downloader Type',
        'duration' => 'Duration',
        'download_link' => 'Download Link',
    ],
];

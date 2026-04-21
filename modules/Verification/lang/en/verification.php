<?php

declare(strict_types=1);

return [
    'validation' => [
        'code' => [
            'required' => 'Verification code is required',
            'size' => 'Verification code must be 6 digits',
        ],
        'type' => [
            'required' => 'Verification type is required',
        ],
    ],
    'messages' => [
        'code_sent_email' => 'Verification code sent to your email',
        'code_sent_whatsapp' => 'Verification code sent to WhatsApp',
        'verified' => 'Verified successfully',
        'settings_updated' => 'Verification settings updated successfully',
        'test_email_sent' => 'Test message sent to :email',
        'test_whatsapp_sent' => 'Test message sent to :phone',
    ],
    'errors' => [
        'email_disabled' => 'Email verification is disabled',
        'whatsapp_disabled' => 'WhatsApp verification is disabled',
        'no_email' => 'No email address registered',
        'no_phone' => 'No phone number registered',
        'invalid_code' => 'Invalid verification code',
        'code_expired' => 'Verification code has expired',
        'test_email_required' => 'Please provide an email for testing',
        'test_phone_required' => 'Please provide a phone number for testing',
    ],
];

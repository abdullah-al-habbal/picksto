<?php

// modules/LemonSqueezy/lang/en/lemonsqueezy.php

declare(strict_types=1);

return [
    'validation' => [
        'variantId' => [
            'required' => 'Variant ID is required',
        ],
    ],
    'messages' => [
        'checkout_created' => 'Checkout link created successfully',
        'webhook_received' => 'Event received successfully',
    ],
    'errors' => [
        'checkout_failed' => 'Failed to create checkout link, please try again',
        'fetch_failed' => 'Failed to fetch data from Lemon Squeezy',
    ],
    'labels' => [
        'products' => 'Products',
        'customers' => 'Customers',
        'subscriptions' => 'Subscriptions',
        'checkout' => 'Checkout',
    ],
];

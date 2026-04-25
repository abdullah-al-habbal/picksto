<?php

declare(strict_types=1);

return [
    'validation' => [
        'code' => [
            'size' => 'Currency code must be 3 characters',
        ],
        'decimalSeparator' => [
            'size' => 'Decimal separator must be 1 character',
        ],
    ],
    'messages' => [
        'updated' => 'Currency settings updated successfully',
    ],
    'errors' => [
        'update_failed' => 'Failed to update currency settings',
    ],
    'labels' => [
        'currencies' => 'Currencies',
        'plural' => 'Currencies',
        'singular' => 'Currency',
        'code' => 'Currency Code',
        'symbol' => 'Symbol',
        'name' => 'Currency Name',
        'decimalPlaces' => 'Decimal Places',
        'decimalSeparator' => 'Decimal Separator',
        'thousandsSeparator' => 'Thousands Separator',
        'symbolPosition' => 'Symbol Position',
        'spaceBetween' => 'Space Between',
        'before' => 'Before',
        'after' => 'After',
    ],
    'fields' => [
        'code' => 'Code',
        'symbol' => 'Symbol',
        'name' => 'Name',
        'decimal_places' => 'Decimal Places',
        'decimal_separator' => 'Decimal Separator',
        'thousands_separator' => 'Thousands Separator',
        'symbol_position' => 'Symbol Position',
        'space_between' => 'Space Between',
        'is_active' => 'Is Active',
    ],
];

<?php

// Product/lang/en/product.php

declare(strict_types=1);

return [
    'validation' => [
        'name_ar' => [
            'required' => 'Product name in Arabic is required',
        ],
        'price' => [
            'required' => 'Price is required',
            'numeric' => 'Price must be a number',
        ],
    ],
    'messages' => [
        'created' => 'Product created successfully',
        'updated' => 'Product updated successfully',
        'deleted' => 'Product deleted successfully',
    ],
    'errors' => [
        'create_failed' => 'Failed to create product',
        'update_failed' => 'Failed to update product',
        'delete_failed' => 'Failed to delete product',
    ],
];

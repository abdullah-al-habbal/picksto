<?php

declare(strict_types=1);

return [
    'validation' => [
        'name.ar' => [
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
        'catalog_empty' => 'No products are available at the moment.',
    ],
    'errors' => [
        'create_failed' => 'Failed to create product',
        'update_failed' => 'Failed to update product',
        'delete_failed' => 'Failed to delete product',
    ],
    'labels' => [
        'products' => 'Products',
        'catalog' => 'Product Catalog',
        'plural' => 'Products',
        'singular' => 'Product',
    ],
    'fields' => [
        'name' => 'Name',
        'price' => 'Price',
        'currency' => 'Currency',
        'sort_order' => 'Sort Order',
        'is_active' => 'Active',
        'description' => 'Description',
        'image' => 'Image',
    ],
];

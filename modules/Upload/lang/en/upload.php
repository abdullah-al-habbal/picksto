<?php

declare(strict_types=1);

return [
    'validation' => [
        'file' => [
            'required' => 'Please select a file',
            'image' => 'File must be an image',
            'max' => 'File size must not exceed 5MB',
        ],
        'folder' => [
            'required' => 'Folder is required',
            'in' => 'Invalid folder',
        ],
        'filename' => [
            'required' => 'Filename is required',
            'regex' => 'Invalid filename',
        ],
    ],
    'messages' => [
        'logo_uploaded' => 'Logo uploaded successfully',
        'favicon_uploaded' => 'Favicon uploaded successfully',
        'product_uploaded' => 'Product image uploaded successfully',
        'avatar_uploaded' => 'Avatar uploaded successfully',
        'file_deleted' => 'File deleted successfully',
    ],
    'errors' => [
        'invalid_folder' => 'Invalid folder',
        'file_not_found' => 'File not found',
    ],
];

<?php

// modules/User/lang/en/user.php

declare(strict_types=1);

return [
    'validation' => [
        'name' => [
            'required' => 'Name is required',
            'min' => 'Name must be at least 2 characters',
        ],
        'email' => [
            'email' => 'Invalid email format',
            'unique' => 'Email already registered',
        ],
        'phone' => [
            'regex' => 'Invalid phone format. Must start with country code like +966',
        ],
        'avatar' => [
            'required' => 'Please select an image',
            'image' => 'File must be an image',
            'max' => 'Image size must not exceed 5MB',
        ],
    ],
    'messages' => [
        'profile_updated' => 'Profile updated successfully',
        'avatar_uploaded' => 'Avatar uploaded successfully',
        'role_updated' => 'User role updated successfully',
        'user_banned' => 'User has been banned',
        'user_unbanned' => 'User has been unbanned',
        'package_activated' => 'Package activated for :days days',
        'account_banned' => 'This account is banned, please contact support',
    ],
    'actions' => [
        'change_role' => 'Change Role',
        'ban' => 'Ban User',
        'unban' => 'Unban User',
        'activate_package' => 'Activate Package',
    ],
    'fields' => [
        'is_banned' => 'Is Banned',
        'duration_days' => 'Duration (days)',
    ],
    'errors' => [
        'profile_update_failed' => 'Failed to update profile, please try again',
        'avatar_upload_failed' => 'Failed to upload avatar, please try again',
        'user_not_found' => 'User not found',
    ],
    'labels' => [
        'name' => 'Full Name',
        'email' => 'Email Address',
        'phone' => 'Phone Number',
        'profession' => 'Profession',
        'companySize' => 'Company Size',
        'role' => 'Role',
        'status' => 'Status',
        'avatar' => 'Profile Picture',
        'profile' => 'Profile',
        'edit_profile' => 'Edit Profile',
        'save_changes' => 'Save Changes',
    ],
];

<?php
// modules/Auth/lang/en/auth.php

declare(strict_types=1);

return [
    'validation' => [
        'fullName' => [
            'required' => 'Full name is required',
            'min' => 'Name must be at least 2 characters',
        ],
        'email' => [
            'required' => 'Email is required',
            'email' => 'Invalid email format',
            'unique' => 'Email already registered',
        ],
        'password' => [
            'required' => 'Password is required',
            'confirmed' => 'Password confirmation does not match',
            'min' => 'Password must be at least 8 characters',
        ],
        'phone' => [
            'regex' => 'Invalid phone format. Must start with country code like +966',
        ],
        'token' => [
            'required' => 'Reset token is required',
        ],
        'referredBy' => [
            'exists' => 'Invalid referral code',
        ],
        'credentials' => 'Invalid credentials',
        'banned' => 'This account is banned',
    ],
    'messages' => [
        'registered' => 'Your account has been created successfully',
        'logged_in' => 'Logged in successfully',
        'password_sent' => 'Password reset link sent to your email',
        'password_reset' => 'Password has been reset successfully',
    ],
    'errors' => [
        'registration_failed' => 'Registration failed, please try again',
        'login_failed' => 'Login failed',
    ],
    'labels' => [
        'fullName' => 'Full Name',
        'email' => 'Email Address',
        'password' => 'Password',
        'passwordConfirmation' => 'Confirm Password',
        'phone' => 'Phone Number',
        'profession' => 'Profession',
        'companySize' => 'Company Size',
        'referredBy' => 'Referral Code (Optional)',
        'login' => 'Login',
        'register' => 'Register',
        'forgotPassword' => 'Forgot Password?',
        'resetPassword' => 'Reset Password',
    ],
];

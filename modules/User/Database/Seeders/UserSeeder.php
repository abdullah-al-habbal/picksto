<?php
// modules/User/Database/Seeders/UserSeeder.php

declare(strict_types=1);

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\User\Models\UserModel;

final class UserSeeder extends Seeder
{
    public function run(): void
    {
        UserModel::firstOrCreate(
            ['email' => 'admin@picksto.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('Admin@123'),
                'role' => 'admin',
                'email_verified' => true,
                'phone_verified' => true,
                'referral_code' => 'ADMIN01',
            ]
        );

        UserModel::firstOrCreate(
            ['email' => 'supervisor@picksto.com'],
            [
                'name' => 'Supervisor User',
                'password' => Hash::make('Supervisor@123'),
                'role' => 'supervisor',
                'email_verified' => true,
                'phone_verified' => true,
                'referral_code' => 'SUPER01',
            ]
        );

        if (app()->environment('local')) {
            UserModel::factory()->count(10)->create();

            $referrer = UserModel::factory()->create(['referral_code' => 'REF001']);

            UserModel::factory()->count(5)->create(['referred_by' => $referrer->id]);
        }
    }
}

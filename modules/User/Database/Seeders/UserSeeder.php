<?php
// modules/User/Database/Seeders/UserSeeder.php
declare(strict_types=1);

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\Language\Models\LanguageModel;
use Modules\Currency\Models\CurrencySettingModel;
use Modules\User\Models\UserModel;
use Modules\User\Models\UserSettingModel;
use Faker\Factory;
final class UserSeeder extends Seeder
{
    public function run(): void
    {
        $defaultLanguage = LanguageModel::where('is_default', true)->first();
        $defaultCurrency = CurrencySettingModel::first();

        $admin = UserModel::firstOrCreate(
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

        $supervisor = UserModel::firstOrCreate(
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

        UserSettingModel::firstOrCreate(['user_id' => $admin->id], [
            'language_id' => $defaultLanguage?->id,
            'currency_id' => $defaultCurrency?->id,
        ]);

        UserSettingModel::firstOrCreate(['user_id' => $supervisor->id], [
            'language_id' => $defaultLanguage?->id,
            'currency_id' => $defaultCurrency?->id,
        ]);

        if (app()->environment('local')) {
            $users = [];
            for ($i = 0; $i < 10; $i++) {
                $users[] = $this->makeUserArray('user');
            }

            $referrerData = $this->makeUserArray('user', ['referral_code' => 'REF001']);
            $referrerId = DB::table('users')->insertGetId($referrerData);

            for ($i = 0; $i < 5; $i++) {
                $users[] = $this->makeUserArray('user', ['referred_by' => $referrerId]);
            }

            DB::table('users')->insert($users);

            $newUserIds = DB::table('users')
                ->whereNotIn('email', ['admin@picksto.com', 'supervisor@picksto.com'])
                ->pluck('id')
                ->toArray();

            $settingsInsert = [];
            foreach ($newUserIds as $uid) {
                $settingsInsert[] = [
                    'user_id' => $uid,
                    'language_id' => $defaultLanguage?->id,
                    'currency_id' => $defaultCurrency?->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            if (!empty($settingsInsert)) {
                DB::table('user_settings')->insert($settingsInsert);
            }
        }
    }

    private function makeUserArray(string $role = 'user', array $overrides = []): array
    {
        $faker = Factory::create();
        return array_merge([
            'name' => $faker->name(),
            'email' => $faker->unique()->safeEmail(),
            'password' => bcrypt('password'),
            'phone' => $faker->phoneNumber(),
            'role' => $role,
            'referral_code' => strtoupper($faker->unique()->lexify('??????')),
            'email_verified' => true,
            'phone_verified' => true,
            'is_banned' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ], $overrides);
    }
}

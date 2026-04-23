<?php

// modules/Subscription/Database/Seeders/SubscriptionSeeder.php

declare(strict_types=1);

namespace Modules\Subscription\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Package\Models\PackageModel;
use Modules\Subscription\Models\SubscriptionModel;
use Modules\User\Models\UserModel;

final class SubscriptionSeeder extends Seeder
{
    public function run(): void
    {
        $admin = UserModel::where('email', 'admin@picksto.com')->first();
        $packages = PackageModel::all();

        if ($admin && $packages->isNotEmpty()) {
            SubscriptionModel::updateOrCreate(
                ['user_id' => $admin->id, 'package_id' => $packages->first()->id],
                [
                    'status' => 'active',
                    'start_date' => now(),
                    'end_date' => now()->addDays(365),
                    'downloads_today' => 0,
                    'downloads_month' => 0,
                    'payment_method' => 'manual',
                ]
            );
        }

        if (app()->environment('local')) {
            $users = UserModel::where('id', '!=', $admin?->id)->limit(5)->get();

            foreach ($users as $user) {
                SubscriptionModel::factory()
                    ->active()
                    ->for($user)
                    ->for($packages->random())
                    ->create();
            }
        }
    }
}

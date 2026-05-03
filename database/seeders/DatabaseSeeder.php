<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Analytics\Database\Seeders\AnalyticsSeeder;
use Modules\Currency\Database\Seeders\CurrencySeeder;
use Modules\Language\Database\Seeders\LanguageSeeder;
use Modules\Download\Database\Seeders\DownloadSeeder;
use Modules\Package\Database\Seeders\PackageSeeder;
use Modules\Payment\Database\Seeders\PaymentSeeder;
use Modules\Product\Database\Seeders\ProductSeeder;
use Modules\Referral\Database\Seeders\ReferralSeeder;
use Modules\Settings\Database\Seeders\SettingsSeeder;
use Modules\Subscription\Database\Seeders\SubscriptionSeeder;
use Modules\Ticket\Database\Seeders\TicketSeeder;
use Modules\User\Database\Seeders\UserSeeder;
use Modules\User\Database\Seeders\UserSettingSeeder;
use Modules\Verification\Database\Seeders\VerificationSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CurrencySeeder::class,
            LanguageSeeder::class,
            UserSeeder::class,
            UserSettingSeeder::class,
            PackageSeeder::class,
            ProductSeeder::class,
            TicketSeeder::class,
            PaymentSeeder::class,
            ReferralSeeder::class,
            VerificationSeeder::class,
            SettingsSeeder::class,
            SubscriptionSeeder::class,
            DownloadSeeder::class,
            AnalyticsSeeder::class,
        ]);
    }
}

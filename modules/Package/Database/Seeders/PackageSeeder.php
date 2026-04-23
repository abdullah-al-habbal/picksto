<?php

// modules/Package/Database/Seeders/PackageSeeder.php

declare(strict_types=1);

namespace Modules\Package\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Package\Models\PackageModel;

final class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            [
                'name' => [
                    'ar' => 'باقة المبتدئين',
                    'en' => 'Starter Package',
                ],
                'description' => [
                    'ar' => 'مثالية للمبتدئين الذين يبدأون رحلتهم',
                    'en' => 'Perfect for beginners starting their journey',
                ],
                'price' => 49.00,
                'currency' => 'SAR',
                'daily_limit' => 5,
                'monthly_limit' => 50,
                'allowed_sites' => json_encode(['Freepik']),
                'duration_days' => 30,
                'is_active' => true,
            ],
            [
                'name' => [
                    'ar' => 'باقة المحترفين',
                    'en' => 'Professional Package',
                ],
                'description' => [
                    'ar' => 'للمحترفين الذين يحتاجون إلى المزيد من الميزات',
                    'en' => 'For professionals who need more features',
                ],
                'price' => 149.00,
                'currency' => 'SAR',
                'daily_limit' => 20,
                'monthly_limit' => 200,
                'allowed_sites' => json_encode(['Freepik', 'Flaticon', 'Envato Elements']),
                'duration_days' => 30,
                'is_active' => true,
            ],
            [
                'name' => [
                    'ar' => 'باقة الشركات',
                    'en' => 'Enterprise Package',
                ],
                'description' => [
                    'ar' => 'للفرق والشركات التي تحتاج إلى وصول غير محدود',
                    'en' => 'For teams and businesses needing unlimited access',
                ],
                'price' => 499.00,
                'currency' => 'SAR',
                'daily_limit' => 50,
                'monthly_limit' => 500,
                'allowed_sites' => json_encode(['All']),
                'duration_days' => 30,
                'is_active' => true,
            ],
        ];

        foreach ($packages as $package) {
            PackageModel::updateOrCreate(
                ['name->ar' => $package['name']['ar']],
                $package
            );
        }
    }
}

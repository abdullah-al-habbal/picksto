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
                'name_ar' => 'باقة المبتدئين',
                'name_en' => 'Starter Package',
                'description_ar' => 'مثالية للمبتدئين الذين يبدأون رحلتهم',
                'description_en' => 'Perfect for beginners starting their journey',
                'price' => 49.00,
                'currency' => 'SAR',
                'daily_limit' => 5,
                'monthly_limit' => 50,
                'allowed_sites' => json_encode(['Freepik']),
                'duration_days' => 30,
                'is_active' => true,
            ],
            [
                'name_ar' => 'باقة المحترفين',
                'name_en' => 'Professional Package',
                'description_ar' => 'للمحترفين الذين يحتاجون إلى المزيد من الميزات',
                'description_en' => 'For professionals who need more features',
                'price' => 149.00,
                'currency' => 'SAR',
                'daily_limit' => 20,
                'monthly_limit' => 200,
                'allowed_sites' => json_encode(['Freepik', 'Flaticon', 'Envato Elements']),
                'duration_days' => 30,
                'is_active' => true,
            ],
            [
                'name_ar' => 'باقة الشركات',
                'name_en' => 'Enterprise Package',
                'description_ar' => 'للفرق والشركات التي تحتاج إلى وصول غير محدود',
                'description_en' => 'For teams and businesses needing unlimited access',
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
                ['name_ar' => $package['name_ar']],
                $package
            );
        }
    }
}

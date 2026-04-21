<?php

// Product/Database/Seeders/ProductSeeder.php

declare(strict_types=1);

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Product\Models\ProductModel;

final class ProductSeeder extends Seeder
{
    public function run(): void
    {
        if (app()->environment('local')) {
            ProductModel::factory()->count(10)->create();
        }
    }
}

<?php
// Currency/Database/Seeders/CurrencySeeder.php

declare(strict_types=1);

namespace Modules\Currency\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Currency\Models\CurrencySettingModel;

final class CurrencySeeder extends Seeder
{
    public function run(): void
    {
        CurrencySettingModel::updateOrCreate(
            ['id' => 1],
            [
                'code' => 'SAR',
                'symbol' => 'ر.س',
                'name' => 'Saudi Riyal',
                'decimal_places' => 2,
                'decimal_separator' => '.',
                'thousands_separator' => ',',
                'symbol_position' => true,
                'space_between' => false,
            ]
        );
    }
}

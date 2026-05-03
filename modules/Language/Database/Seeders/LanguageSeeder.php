<?php

declare(strict_types=1);

namespace Modules\Language\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Language\Models\LanguageModel;

final class LanguageSeeder extends Seeder
{
    public function run(): void
    {
        LanguageModel::firstOrCreate(
            ['code' => 'en'],
            [
                'name' => 'English',
                'is_active' => true,
                'is_default' => true,
                'is_rtl' => false,
            ]
        );

        LanguageModel::firstOrCreate(
            ['code' => 'ar'],
            [
                'name' => 'Arabic',
                'is_active' => true,
                'is_default' => false,
                'is_rtl' => true,
            ]
        );
    }
}

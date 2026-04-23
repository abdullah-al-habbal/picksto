<?php

// modules/Download/Database/Seeders/DownloadSeeder.php

declare(strict_types=1);

namespace Modules\Download\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Download\Models\DownloadModel;

final class DownloadSeeder extends Seeder
{
    public function run(): void
    {
        if (app()->environment('local')) {
            DownloadModel::factory()->count(50)->completed()->create();
            DownloadModel::factory()->count(5)->failed()->create();
            DownloadModel::factory()->count(2)->state(['status' => 'pending'])->create();
        }
    }
}

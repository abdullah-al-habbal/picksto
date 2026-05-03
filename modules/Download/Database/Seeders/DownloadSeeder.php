<?php

declare(strict_types=1);

namespace Modules\Download\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\User\Models\UserModel;

final class DownloadSeeder extends Seeder
{
    public function run(): void
    {
        if (!app()->environment('local')) {
            return;
        }

        $userIds = UserModel::pluck('id')->toArray();
        if (empty($userIds)) {
            return;
        }

        $productIds = DB::table('products')->pluck('id')->toArray();
        $packageIds = DB::table('packages')->pluck('id')->toArray();

        $chunkSize = 1000;
        $total = 10000;
        $data = [];

        $sources = ['Freepik', 'Flaticon', 'Envato Elements', 'MotionArray'];

        for ($i = 0; $i < $total; $i++) {
            $type = fake()->randomElement(['product', 'package']);
            if ($type === 'product' && !empty($productIds)) {
                $downloadableType = 'product';
                $downloadableId = $productIds[array_rand($productIds)];
            } elseif (!empty($packageIds)) {
                $downloadableType = 'package';
                $downloadableId = $packageIds[array_rand($packageIds)];
            } else {
                continue;
            }

            $data[] = [
                'user_id' => $userIds[array_rand($userIds)],
                'original_url' => 'https://example.com/download/' . fake()->uuid(),
                'file_name' => fake()->slug() . '.zip',
                'site_source' => $sources[array_rand($sources)],
                'status' => 'completed',
                'download_path' => '/downloads/' . fake()->slug() . '.zip',
                'ip_address' => fake()->ipv4(),
                'error_message' => null,
                'downloadable_type' => $downloadableType,
                'downloadable_id' => $downloadableId,
                'downloaded_at' => now()->subDays(rand(0, 30)),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (count($data) >= $chunkSize) {
                DB::table('downloads')->insert($data);
                $data = [];
            }
        }

        if (!empty($data)) {
            DB::table('downloads')->insert($data);
        }
    }
}

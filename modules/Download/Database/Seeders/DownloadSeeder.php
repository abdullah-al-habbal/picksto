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
        if (! app()->environment('local')) {
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

        for ($i = 0; $i < $total; $i++) {
            $data[] = [
                'user_id'       => $userIds[array_rand($userIds)],
                'product_id'    => !empty($productIds) ? $productIds[array_rand($productIds)] : null,
                'package_id'    => !empty($packageIds) ? $packageIds[array_rand($packageIds)] : null,
                'status'        => 'completed',
                'downloaded_at' => now()->subDays(rand(0, 30)),
                'created_at'    => now(),
                'updated_at'    => now(),
            ];

            if (count($data) >= $chunkSize) {
                DB::table('downloads')->insert($data);
                $data = [];
            }
        }

        if (! empty($data)) {
            DB::table('downloads')->insert($data);
        }
    }
}

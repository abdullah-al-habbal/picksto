<?php

// modules/Download/Database/Factories/DownloadModelFactory.php

declare(strict_types=1);

namespace Modules\Download\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Download\Models\DownloadModel;
use Modules\Package\Models\PackageModel;
use Modules\Product\Models\ProductModel;
use Modules\User\Models\UserModel;

final class DownloadModelFactory extends Factory
{
    protected $model = DownloadModel::class;

    public function definition(): array
    {
        $parentType = fake()->randomElement(['product', 'package']);

        if ($parentType === 'product') {
            $downloadableType = ProductModel::class;
            $downloadableId = ProductModel::factory();
        } else {
            $downloadableType = PackageModel::class;
            $downloadableId = PackageModel::factory();
        }

        return [
            'user_id' => UserModel::factory(),
            'original_url' => fake()->url(),
            'file_name' => fake()->slug() . '.zip',
            'site_source' => fake()->randomElement(['Freepik', 'Flaticon', 'Envato Elements', 'MotionArray']),
            'status' => fake()->randomElement(['pending', 'processing', 'completed', 'failed']),
            'download_path' => '/downloads/' . fake()->slug() . '.zip',
            'ip_address' => fake()->ipv4(),
            'error_message' => null,
            'downloadable_type' => $downloadableType,
            'downloadable_id' => $downloadableId,
            'downloaded_at' => fake()->optional()->dateTimeBetween('-30 days', 'now'),
        ];
    }

    public function completed(): static
    {
        return $this->state(fn(array $attributes): array => [
            'status' => 'completed',
        ]);
    }

    public function failed(): static
    {
        return $this->state(fn(array $attributes): array => [
            'status' => 'failed',
            'error_message' => 'Download failed',
        ]);
    }
}

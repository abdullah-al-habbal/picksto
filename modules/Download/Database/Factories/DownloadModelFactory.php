<?php

// modules/Download/Database/Factories/DownloadModelFactory.php

declare(strict_types=1);

namespace Modules\Download\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Download\Models\DownloadModel;
use Modules\User\Models\UserModel;

final class DownloadModelFactory extends Factory
{
    protected $model = DownloadModel::class;

    public function definition(): array
    {
        return [
            'user_id' => UserModel::factory(),
            'original_url' => fake()->url(),
            'file_name' => fake()->slug() . '.zip',
            'site_source' => fake()->randomElement(['Freepik', 'Flaticon', 'Envato Elements', 'MotionArray']),
            'status' => fake()->randomElement(['pending', 'processing', 'completed', 'failed']),
            'download_path' => '/downloads/' . fake()->slug() . '.zip',
            'ip_address' => fake()->ipv4(),
            'error_message' => null,
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

<?php

// Settings/Database/Factories/SettingModelFactory.php

declare(strict_types=1);

namespace Modules\Settings\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

final class SettingModelFactory extends Factory
{
    public function definition(): array
    {
        return [
            'key_name' => fake()->unique()->word(),
            'value' => json_encode(['test' => fake()->sentence()]),
            'group' => fake()->randomElement(['general', 'site', 'download', 'bot']),
            'description' => fake()->optional()->sentence(),
        ];
    }

    public function siteConfig(): static
    {
        return $this->state(fn (array $attributes): array => [
            'key_name' => 'site_config',
            'group' => 'site',
            'value' => json_encode([
                'logo' => '/uploads/logos/default.webp',
                'favicon' => '/uploads/favicons/default.webp',
                'site_name' => 'PickSto',
                'site_description' => 'Download assets from multiple sources',
                'botBrowserVisible' => false,
                'downloadProviders' => [],
            ]),
        ]);
    }
}

<?php

// Settings/Repositories/SettingsRepository.php

declare(strict_types=1);

namespace Modules\Settings\Repositories;

use Modules\Settings\Models\SettingModel;

final class SettingsRepository
{
    public function __construct(
        private readonly SettingModel $model,
    ) {}

    public function getSettings(bool $isAdmin = false): array
    {
        $siteConfig = $this->model->newQuery()
            ->where('key_name', 'site_config')
            ->first()?->value ?? [];

        if (! $isAdmin) {
            // Hide sensitive config from non-admins
            unset($siteConfig['downloadProviders']);
        }

        return [
            'siteConfig' => $siteConfig,
        ];
    }

    public function updateSettings(array $data): SettingModel
    {
        $currentConfig = $this->model->newQuery()
            ->where('key_name', 'site_config')
            ->first()?->value ?? [];

        $newConfig = array_merge($currentConfig, [
            'site_name' => $data['siteName'] ?? $currentConfig['site_name'] ?? null,
            'site_description' => $data['siteDescription'] ?? $currentConfig['site_description'] ?? null,
            'logo' => $data['logo'] ?? $currentConfig['logo'] ?? null,
            'favicon' => $data['favicon'] ?? $currentConfig['favicon'] ?? null,
            'botBrowserVisible' => $data['botBrowserVisible'] ?? $currentConfig['botBrowserVisible'] ?? false,
            'downloadProviders' => $data['downloadProviders'] ?? $currentConfig['downloadProviders'] ?? [],
        ]);

        return $this->model->newQuery()->updateOrCreate(
            ['key_name' => 'site_config'],
            [
                'value' => $newConfig,
                'group' => 'site',
                'description' => 'Main site configuration',
            ]
        );
    }

    public function getSiteConfig(): array
    {
        return $this->model->newQuery()
            ->where('key_name', 'site_config')
            ->first()?->value ?? [];
    }

    public function updateSiteConfig(array $config): SettingModel
    {
        return $this->model->newQuery()->updateOrCreate(
            ['key_name' => 'site_config'],
            [
                'value' => $config,
                'group' => 'site',
                'description' => 'Main site configuration',
            ]
        );
    }
}

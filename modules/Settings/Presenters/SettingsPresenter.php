<?php

// Settings/Presenters/SettingsPresenter.php

declare(strict_types=1);

namespace Modules\Settings\Presenters;

final class SettingsPresenter
{
    public function present(array $settings): array
    {
        return [
            'siteName' => $settings['siteConfig']['site_name'] ?? null,
            'siteDescription' => $settings['siteConfig']['site_description'] ?? null,
            'logo' => $settings['siteConfig']['logo'] ?? null,
            'favicon' => $settings['siteConfig']['favicon'] ?? null,
            'botBrowserVisible' => $settings['siteConfig']['botBrowserVisible'] ?? false,
        ];
    }
}

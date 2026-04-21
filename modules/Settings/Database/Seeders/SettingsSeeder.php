<?php

// Settings/Database/Seeders/SettingsSeeder.php

declare(strict_types=1);

namespace Modules\Settings\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Settings\Models\SettingModel;

final class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        SettingModel::updateOrCreate(
            ['key_name' => 'site_config'],
            [
                'group' => 'site',
                'description' => 'Main site configuration',
                'value' => json_encode([
                    'logo' => '/uploads/logos/default.webp',
                    'favicon' => '/uploads/favicons/default.webp',
                    'site_name' => config('app.name', 'PickSto'),
                    'site_description' => 'Download assets from multiple sources',
                    'botBrowserVisible' => false,
                    'downloadProviders' => [],
                ]),
            ]
        );
    }
}

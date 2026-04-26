<?php

declare(strict_types=1);

namespace Modules\Settings\Filament\Admin\Resources\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\Settings\Filament\Admin\Resources\SettingResource;

class ViewSetting extends ViewRecord
{
    protected static string $resource = SettingResource::class;
}

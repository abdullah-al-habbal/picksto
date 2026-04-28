<?php

declare(strict_types=1);

namespace Modules\Settings\Filament\Admin\Resources\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Settings\Filament\Admin\Resources\SettingResource;

final class CreateSetting extends CreateRecord
{
    protected static string $resource = SettingResource::class;
}

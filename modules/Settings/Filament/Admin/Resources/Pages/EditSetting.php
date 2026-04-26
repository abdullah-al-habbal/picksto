<?php

declare(strict_types=1);

namespace Modules\Settings\Filament\Admin\Resources\Pages;

use Filament\Resources\Pages\EditRecord;
use Modules\Settings\Filament\Admin\Resources\SettingResource;

class EditSetting extends EditRecord
{
    protected static string $resource = SettingResource::class;
}

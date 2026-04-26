<?php

declare(strict_types=1);

namespace Modules\Settings\Filament\Admin\Resources\Pages;

use Filament\Resources\Pages\ListRecords;
use Modules\Settings\Filament\Admin\Resources\SettingResource;

class ListSettings extends ListRecords
{
    protected static string $resource = SettingResource::class;
}

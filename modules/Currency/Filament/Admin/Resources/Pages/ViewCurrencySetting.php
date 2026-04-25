<?php

declare(strict_types=1);

namespace Modules\Currency\Filament\Admin\Resources\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\Currency\Filament\Admin\Resources\CurrencySettingResource;

class ViewCurrencySetting extends ViewRecord
{
    protected static string $resource = CurrencySettingResource::class;
}

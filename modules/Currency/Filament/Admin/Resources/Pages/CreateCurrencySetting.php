<?php

declare(strict_types=1);

namespace Modules\Currency\Filament\Admin\Resources\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Currency\Filament\Admin\Resources\CurrencySettingResource;

class CreateCurrencySetting extends CreateRecord
{
    protected static string $resource = CurrencySettingResource::class;
}

<?php

declare(strict_types=1);

namespace Modules\Currency\Filament\Admin\Resources\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Currency\Filament\Admin\Resources\CurrencySettingResource;

class EditCurrencySetting extends EditRecord
{
    protected static string $resource = CurrencySettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

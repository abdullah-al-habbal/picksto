<?php

declare(strict_types=1);

namespace Modules\Currency\Filament\Admin\Resources\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Currency\Filament\Admin\Resources\CurrencySettingResource;

class ListCurrencySettings extends ListRecords
{
    protected static string $resource = CurrencySettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

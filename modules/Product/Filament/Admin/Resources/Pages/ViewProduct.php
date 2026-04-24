<?php

declare(strict_types=1);

namespace Modules\Product\Filament\Admin\Resources\Pages;

use LaraZeus\SpatieTranslatable\Resources\Concerns\HasActiveLocaleSwitcher;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\Product\Filament\Admin\Resources\ProductResource;

class ViewProduct extends ViewRecord
{
    use HasActiveLocaleSwitcher;

    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

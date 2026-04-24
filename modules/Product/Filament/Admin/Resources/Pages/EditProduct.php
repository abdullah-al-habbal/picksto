<?php

declare(strict_types=1);

namespace Modules\Product\Filament\Admin\Resources\Pages;

use LaraZeus\SpatieTranslatable\Resources\Concerns\HasActiveLocaleSwitcher;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Product\Filament\Admin\Resources\ProductResource;

class EditProduct extends EditRecord
{
    use HasActiveLocaleSwitcher;

    protected string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

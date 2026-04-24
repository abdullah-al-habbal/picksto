<?php

declare(strict_types=1);

namespace Modules\Product\Filament\Admin\Resources\Pages;

use LaraZeus\SpatieTranslatable\Resources\Concerns\HasActiveLocaleSwitcher;
use Filament\Resources\Pages\CreateRecord;
use Modules\Product\Filament\Admin\Resources\ProductResource;

class CreateProduct extends CreateRecord
{
    use HasActiveLocaleSwitcher;

    protected string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}

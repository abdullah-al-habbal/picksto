<?php

declare(strict_types=1);

namespace Modules\Package\Filament\Admin\Resources\Pages;

use LaraZeus\SpatieTranslatable\Resources\Concerns\HasActiveLocaleSwitcher;
use Modules\Package\Filament\Admin\Resources\PackageResource;
use Filament\Resources\Pages\ListRecords;

class ListPackages extends ListRecords
{
    use HasActiveLocaleSwitcher;

    protected static string $resource = PackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}

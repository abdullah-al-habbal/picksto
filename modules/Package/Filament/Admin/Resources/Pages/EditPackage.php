<?php

declare(strict_types=1);

namespace Modules\Package\Filament\Admin\Resources\Pages;

use Filament\Resources\Pages\EditRecord;
use LaraZeus\SpatieTranslatable\Resources\Concerns\HasActiveLocaleSwitcher;
use Modules\Package\Filament\Admin\Resources\PackageResource;

class EditPackage extends EditRecord
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

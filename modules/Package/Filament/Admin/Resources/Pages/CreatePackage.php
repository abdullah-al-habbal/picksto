<?php

declare(strict_types=1);

namespace Modules\Package\Filament\Admin\Resources\Pages;

use Filament\Resources\Pages\CreateRecord;
use LaraZeus\SpatieTranslatable\Resources\Concerns\HasActiveLocaleSwitcher;
use Modules\Package\Filament\Admin\Resources\PackageResource;

class CreatePackage extends CreateRecord
{
    use HasActiveLocaleSwitcher;

    protected static string $resource = PackageResource::class;
}

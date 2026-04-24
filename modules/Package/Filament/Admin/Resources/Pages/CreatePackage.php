<?php

declare(strict_types=1);

namespace Modules\Package\Filament\Admin\Resources\Pages;

use LaraZeus\SpatieTranslatable\Resources\Concerns\HasActiveLocaleSwitcher;
use Modules\Package\Filament\Admin\Resources\PackageResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePackage extends CreateRecord
{
    use HasActiveLocaleSwitcher;

    protected string $resource = PackageResource::class;
}

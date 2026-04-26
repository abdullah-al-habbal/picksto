<?php

declare(strict_types=1);

namespace Modules\Package\Filament\Admin\Resources\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\Package\Filament\Admin\Resources\PackageResource;

class ViewPackage extends ViewRecord
{
    protected static string $resource = PackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

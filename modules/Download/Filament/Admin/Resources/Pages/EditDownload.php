<?php

declare(strict_types=1);

namespace Modules\Download\Filament\Admin\Resources\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Download\Filament\Admin\Resources\DownloadResource;

final class EditDownload extends EditRecord
{
    protected static string $resource = DownloadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

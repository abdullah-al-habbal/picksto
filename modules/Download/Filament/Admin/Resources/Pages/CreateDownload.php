<?php

declare(strict_types=1);

namespace Modules\Download\Filament\Admin\Resources\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Download\Filament\Admin\Resources\DownloadResource;

final class CreateDownload extends CreateRecord
{
    protected static string $resource = DownloadResource::class;
}

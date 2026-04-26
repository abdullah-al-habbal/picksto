<?php

declare(strict_types=1);

namespace Modules\Download\Filament\Admin\Resources\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\Download\Filament\Admin\Resources\DownloadResource;

class ViewDownload extends ViewRecord
{
    protected static string $resource = DownloadResource::class;
}

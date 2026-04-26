<?php

declare(strict_types=1);

namespace Modules\Download\Filament\Admin\Resources\Pages;

use Filament\Resources\Pages\ListRecords;
use Modules\Download\Filament\Admin\Resources\DownloadResource;

class ListDownloads extends ListRecords
{
    protected static string $resource = DownloadResource::class;
}

<?php

declare(strict_types=1);

namespace Modules\Language\Filament\Admin\Resources\Pages;

use Filament\Resources\Pages\ListRecords;
use Modules\Language\Filament\Admin\Resources\LanguageResource;

class ListLanguages extends ListRecords
{
    protected static string $resource = LanguageResource::class;
}

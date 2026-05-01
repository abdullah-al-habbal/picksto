<?php

declare(strict_types=1);

namespace Modules\Language\Filament\Admin\Resources\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Language\Filament\Admin\Resources\LanguageResource;

class CreateLanguage extends CreateRecord
{
    protected static string $resource = LanguageResource::class;
}

<?php

declare(strict_types=1);

namespace Modules\Language\Filament\Admin\Resources\Pages;

use Filament\Resources\Pages\EditRecord;
use Modules\Language\Filament\Admin\Resources\LanguageResource;

class EditLanguage extends EditRecord
{
    protected static string $resource = LanguageResource::class;
}

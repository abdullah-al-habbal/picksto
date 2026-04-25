<?php

declare(strict_types=1);

namespace Modules\Verification\Filament\Admin\Resources\Pages;

use Filament\Resources\Pages\ListRecords;
use Modules\Verification\Filament\Admin\Resources\VerificationCodeResource;

class ListVerificationCodes extends ListRecords
{
    protected static string $resource = VerificationCodeResource::class;
}

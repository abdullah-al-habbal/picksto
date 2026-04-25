<?php

declare(strict_types=1);

namespace Modules\Verification\Filament\Admin\Resources\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Verification\Filament\Admin\Resources\VerificationCodeResource;

class CreateVerificationCode extends CreateRecord
{
    protected static string $resource = VerificationCodeResource::class;
}

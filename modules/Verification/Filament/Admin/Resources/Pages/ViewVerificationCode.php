<?php

declare(strict_types=1);

namespace Modules\Verification\Filament\Admin\Resources\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\Verification\Filament\Admin\Resources\VerificationCodeResource;

class ViewVerificationCode extends ViewRecord
{
    protected static string $resource = VerificationCodeResource::class;
}

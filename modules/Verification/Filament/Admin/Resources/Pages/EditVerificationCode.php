<?php

declare(strict_types=1);

namespace Modules\Verification\Filament\Admin\Resources\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Verification\Filament\Admin\Resources\VerificationCodeResource;

class EditVerificationCode extends EditRecord
{
    protected static string $resource = VerificationCodeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

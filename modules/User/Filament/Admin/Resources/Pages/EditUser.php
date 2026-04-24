<?php

declare(strict_types=1);

namespace Modules\User\Filament\Admin\Resources\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Modules\User\Filament\Admin\Resources\UserResource;

class EditUser extends EditRecord
{
    protected string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

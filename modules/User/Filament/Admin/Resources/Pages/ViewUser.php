<?php

declare(strict_types=1);

namespace Modules\User\Filament\Admin\Resources\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\User\Filament\Admin\Actions\UserActions;
use Modules\User\Filament\Admin\Resources\UserResource;

class ViewUser extends ViewRecord
{
    protected string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            UserActions::changeRole(),
            UserActions::toggleBan(),
            UserActions::activatePackage(),
        ];
    }
}

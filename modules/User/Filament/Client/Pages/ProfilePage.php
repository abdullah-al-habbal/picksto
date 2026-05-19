<?php

declare(strict_types=1);

namespace Modules\User\Filament\Client\Pages;

use BackedEnum;
use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;
use Modules\User\Filament\Client\Schemas\ProfileForm;

final class ProfilePage extends BaseEditProfile
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-user-circle';

    protected static ?int $navigationSort = 1;

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            ...ProfileForm::fields(),
            $this->getPasswordFormComponent(),
            $this->getPasswordConfirmationFormComponent(),
            $this->getCurrentPasswordFormComponent(),
        ]);
    }

    public static function getNavigationLabel(): string
    {
        return __('user::user.labels.profile');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.navigation.groups.account');
    }
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $user = auth()->user();

        if (isset($data['avatar']) && is_string($data['avatar']) && $data['avatar'] !== $user->avatar) {
            if ($user->avatar) {
                $oldPath = str_replace('/storage/', '', (string) $user->avatar);
                Storage::disk('public')->delete($oldPath);
            }

            if ($data['avatar'] !== '') {
                $data['avatar'] = str_starts_with($data['avatar'], '/storage/')
                    ? $data['avatar']
                    : '/storage/' . $data['avatar'];
            }
        }

        return $data;
    }
}

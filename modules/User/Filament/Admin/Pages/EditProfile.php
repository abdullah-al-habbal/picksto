<?php

declare(strict_types=1);

namespace Modules\User\Filament\Admin\Pages;

use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EditProfile extends BaseEditProfile
{
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                TextInput::make('phone')
                    ->label(__('dashboard.resources.user.fields.phone'))
                    ->tel()
                    ->maxLength(255),
                TextInput::make('profession')
                    ->label(__('dashboard.resources.user.fields.profession'))
                    ->maxLength(255),
                TextInput::make('company_size')
                    ->label(__('dashboard.resources.user.fields.company_size'))
                    ->maxLength(255),
                FileUpload::make('avatar')
                    ->label(__('dashboard.resources.user.fields.avatar'))
                    ->image()
                    ->directory('avatars')
                    ->disk('public')
                    ->avatar()
                    ->imageEditor(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
                $this->getCurrentPasswordFormComponent(),
            ]);
    }
}

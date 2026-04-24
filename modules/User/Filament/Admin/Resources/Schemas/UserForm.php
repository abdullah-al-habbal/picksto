<?php
// picksto-laravel-service\modules\User\Filament\Admin\Resources\Schemas\UserForm.php
declare(strict_types=1);

namespace Modules\User\Filament\Admin\Resources\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

final class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('dashboard.resources.user.fields.name'))
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->label(__('dashboard.resources.user.fields.email'))
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),

                TextInput::make('phone')
                    ->label(__('dashboard.resources.user.fields.phone'))
                    ->tel()
                    ->maxLength(255),

                Select::make('role')
                    ->label(__('dashboard.resources.user.fields.role'))
                    ->options([
                        'admin' => 'Admin',
                        'user' => 'User',
                        'supervisor' => 'Supervisor',
                    ])
                    ->required(),

                TextInput::make('password')
                    ->label(__('dashboard.resources.user.fields.password'))
                    ->password()
                    ->dehydrated(fn($state) => filled($state))
                    ->required(fn(string $context): bool => $context === 'create')
                    ->maxLength(255),
            ]);
    }
}

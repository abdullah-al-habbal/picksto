<?php

declare(strict_types=1);

namespace Modules\User\Filament\Client\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;
use Modules\User\Models\UserModel;

final class ProfileForm
{
    /**
     * @return array<int, mixed>
     */
    public static function fields(): array
    {
        return [
            Section::make(__('user::user.labels.profile'))
                ->description(__('user::user.labels.edit_profile'))
                ->components([
                    FileUpload::make('avatar')
                        ->label(__('user::user.labels.avatar'))
                        ->avatar()
                        ->image()
                        ->maxSize(5 * 1024)
                        ->directory('avatars')
                        ->disk('public')
                        ->deleteUploadedFileUsing(function (string $file): void {
                            Storage::disk('public')->delete($file);
                        }),
                    TextInput::make('name')
                        ->label(__('user::user.labels.name'))
                        ->required()
                        ->minLength(2)
                        ->maxLength(100),
                    TextInput::make('email')
                        ->label(__('user::user.labels.email'))
                        ->email()
                        ->required()
                        ->unique(UserModel::class, 'email', ignoreRecord: true),
                    TextInput::make('phone')
                        ->label(__('user::user.labels.phone'))
                        ->tel(),
                    TextInput::make('profession')
                        ->label(__('user::user.labels.profession'))
                        ->maxLength(100),
                    TextInput::make('company_size')
                        ->label(__('user::user.labels.company_size'))
                        ->maxLength(50),
                ])
                ->columns(2),
        ];
    }

    public static function configure(Schema $schema): Schema
    {
        return $schema->components(self::fields());
    }
}

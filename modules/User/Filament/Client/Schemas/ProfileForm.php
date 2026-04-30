<?php

declare(strict_types=1);

namespace Modules\User\Filament\Client\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;
use Modules\User\Models\UserModel;

class ProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Profile Information')
                    ->description('Update your personal information')
                    ->components([
                        FileUpload::make('avatar')
                            ->label('Avatar')
                            ->avatar()
                            ->image()
                            ->maxSize(5 * 1024)
                            ->directory('avatars')
                            ->deleteUploadedFileUsing(function (string $file): void {
                                Storage::disk('public')->delete($file);
                            }),
                        TextInput::make('name')
                            ->label('Full Name')
                            ->required()
                            ->minLength(2)
                            ->maxLength(100),
                        TextInput::make('email')
                            ->label('Email Address')
                            ->email()
                            ->required()
                            ->unique(UserModel::class, 'email', ignoreRecord: true),
                        TextInput::make('phone')
                            ->label('Phone Number')
                            ->tel()
                            ->placeholder('+1 (555) 000-0000'),
                        TextInput::make('profession')
                            ->label('Profession')
                            ->maxLength(100),
                        TextInput::make('companySize')
                            ->label('Company Size')
                            ->maxLength(50),
                    ])
                    ->columns(2),
            ]);
    }
}

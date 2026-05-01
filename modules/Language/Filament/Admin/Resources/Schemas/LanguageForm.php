<?php

declare(strict_types=1);

namespace Modules\Language\Filament\Admin\Resources\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LanguageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Language Information')
                    ->components([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('code')
                            ->required()
                            ->maxLength(10)
                            ->unique('languages', 'code', ignoreRecord: true),
                        Toggle::make('is_active')
                            ->default(true),
                        Toggle::make('is_default')
                            ->default(false),
                        Toggle::make('is_rtl')
                            ->label('Is RTL?')
                            ->default(false),
                    ])
                    ->columns(2),
            ]);
    }
}

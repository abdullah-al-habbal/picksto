<?php

declare(strict_types=1);

namespace Modules\Package\Filament\Admin\Resources\Schemas;

use Filament\Schemas\Components\Textarea;
use Filament\Schemas\Components\TextInput;
use Filament\Schemas\Schema;

class PackageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('duration')
                    ->required()
                    ->numeric()
                    ->helperText('Duration in days'),
                TextInput::make('downloads_per_day')
                    ->required()
                    ->numeric(),
            ]);
    }
}

<?php

declare(strict_types=1);

namespace Modules\Package\Filament\Admin\Resources\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
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
                TextInput::make('currency')
                    ->default('SAR')
                    ->maxLength(3),
                TextInput::make('duration_days')
                    ->required()
                    ->numeric()
                    ->helperText('Duration in days'),
                TextInput::make('daily_limit')
                    ->required()
                    ->numeric()
                    ->default(10),
                TextInput::make('monthly_limit')
                    ->numeric()
                    ->default(100),
                Select::make('allowed_sites')
                    ->multiple()
                    ->options([
                        'Freepik' => 'Freepik',
                        'Flaticon' => 'Flaticon',
                        'EnvatoElements' => 'Envato Elements',
                        'MotionArray' => 'MotionArray',
                        'Shutterstock' => 'Shutterstock',
                        'AdobeStock' => 'AdobeStock',
                        'Artlist' => 'Artlist',
                        'Pikbest' => 'Pikbest',
                        'Placeit' => 'Placeit',
                    ]),
                Toggle::make('is_active')
                    ->default(true),
            ]);
    }
}

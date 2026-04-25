<?php

declare(strict_types=1);

namespace Modules\Settings\Filament\Admin\Resources\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

final class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('key')
                    ->label(__('settings::settings.fields.key'))
                    ->required()
                    ->disabled()
                    ->maxLength(255),

                TextInput::make('value')
                    ->label(__('settings::settings.fields.value'))
                    ->required(),

                TextInput::make('group')
                    ->label(__('settings::settings.fields.group'))
                    ->maxLength(255),
            ]);
    }
}

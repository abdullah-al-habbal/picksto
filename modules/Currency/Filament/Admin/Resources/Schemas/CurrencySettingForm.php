<?php

declare(strict_types=1);

namespace Modules\Currency\Filament\Admin\Resources\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

final class CurrencySettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->label(__('currency::currency.fields.code'))
                    ->required()
                    ->length(3),

                TextInput::make('symbol')
                    ->label(__('currency::currency.fields.symbol'))
                    ->required(),

                TextInput::make('name')
                    ->label(__('currency::currency.fields.name'))
                    ->required(),

                TextInput::make('decimal_places')
                    ->label(__('currency::currency.fields.decimal_places'))
                    ->numeric()
                    ->default(2)
                    ->required(),

                TextInput::make('decimal_separator')
                    ->label(__('currency::currency.fields.decimal_separator'))
                    ->required()
                    ->length(1)
                    ->default('.'),

                TextInput::make('thousands_separator')
                    ->label(__('currency::currency.fields.thousands_separator'))
                    ->required()
                    ->length(1)
                    ->default(','),

                Select::make('symbol_position')
                    ->label(__('currency::currency.fields.symbol_position'))
                    ->options([
                        'before' => __('currency::currency.labels.before'),
                        'after' => __('currency::currency.labels.after'),
                    ])
                    ->required(),

                Toggle::make('space_between')
                    ->label(__('currency::currency.fields.space_between'))
                    ->default(true),

                Toggle::make('is_active')
                    ->label(__('currency::currency.fields.is_active'))
                    ->default(true),
            ]);
    }
}

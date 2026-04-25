<?php

declare(strict_types=1);

namespace Modules\Currency\Filament\Admin\Resources\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

final class CurrencySettingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('code')
                    ->label(__('currency::currency.fields.code')),

                TextEntry::make('symbol')
                    ->label(__('currency::currency.fields.symbol')),

                TextEntry::make('name')
                    ->label(__('currency::currency.fields.name')),

                TextEntry::make('decimal_places')
                    ->label(__('currency::currency.fields.decimal_places')),

                TextEntry::make('decimal_separator')
                    ->label(__('currency::currency.fields.decimal_separator')),

                TextEntry::make('thousands_separator')
                    ->label(__('currency::currency.fields.thousands_separator')),

                TextEntry::make('symbol_position')
                    ->label(__('currency::currency.fields.symbol_position')),

                IconEntry::make('space_between')
                    ->label(__('currency::currency.fields.space_between'))
                    ->boolean(),

                IconEntry::make('is_active')
                    ->label(__('currency::currency.fields.is_active'))
                    ->boolean(),

                TextEntry::make('created_at')
                    ->label(__('dashboard.fields.created_at'))
                    ->dateTime(),
            ]);
    }
}

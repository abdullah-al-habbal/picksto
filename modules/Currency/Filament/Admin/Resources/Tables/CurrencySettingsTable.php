<?php

declare(strict_types=1);

namespace Modules\Currency\Filament\Admin\Resources\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class CurrencySettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label(__('currency::currency.fields.code'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('symbol')
                    ->label(__('currency::currency.fields.symbol')),

                TextColumn::make('name')
                    ->label(__('currency::currency.fields.name'))
                    ->searchable()
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label(__('currency::currency.fields.is_active'))
                    ->boolean()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label(__('dashboard.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}

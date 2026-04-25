<?php

declare(strict_types=1);

namespace Modules\Settings\Filament\Admin\Resources\Tables;

use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

final class SettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key')
                    ->label(__('settings::settings.fields.key'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('value')
                    ->label(__('settings::settings.fields.value'))
                    ->limit(50),

                TextColumn::make('group')
                    ->label(__('settings::settings.fields.group'))
                    ->badge()
                    ->color('gray')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label(__('dashboard.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('group')
                    ->options(fn () => \Modules\Settings\Models\SettingModel::query()->distinct()->pluck('group', 'group')->toArray()),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ]);
    }
}

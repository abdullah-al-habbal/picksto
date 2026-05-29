<?php

declare(strict_types=1);

namespace Modules\Referral\Filament\Admin\Resources\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class ReferralsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('referrer.name')
                    ->label(__('referral::referral.fields.referrer'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('referred.name')
                    ->label(__('referral::referral.fields.referred'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('registered_at')
                    ->label(__('referral::referral.fields.registered_at'))
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label(__('dashboard.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}

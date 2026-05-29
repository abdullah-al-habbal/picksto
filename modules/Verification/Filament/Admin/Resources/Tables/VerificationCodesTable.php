<?php

declare(strict_types=1);

namespace Modules\Verification\Filament\Admin\Resources\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

final class VerificationCodesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label(__('verification::verification.fields.user'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('type')
                    ->label(__('verification::verification.fields.type'))
                    ->badge()
                    ->color('gray')
                    ->sortable(),

                TextColumn::make('code')
                    ->label(__('verification::verification.fields.code'))
                    ->searchable(),

                TextColumn::make('purpose')
                    ->label(__('verification::verification.fields.purpose'))
                    ->badge()
                    ->color('gray')
                    ->sortable(),

                TextColumn::make('expires_at')
                    ->label(__('verification::verification.fields.expires_at'))
                    ->dateTime()
                    ->sortable(),

                IconColumn::make('is_used')
                    ->label(__('verification::verification.fields.is_used'))
                    ->boolean()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label(__('dashboard.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('purpose')
                    ->options([
                        'registration' => __('verification::verification.purposes.registration'),
                        'reset' => __('verification::verification.purposes.reset'),
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}

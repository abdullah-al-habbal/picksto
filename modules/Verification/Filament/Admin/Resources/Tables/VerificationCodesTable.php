<?php

declare(strict_types=1);

namespace Modules\Verification\Filament\Admin\Resources\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
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

                TextColumn::make('status')
                    ->label(__('verification::verification.fields.status'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'verified' => 'success',
                        'pending' => 'warning',
                        'expired' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('expires_at')
                    ->label(__('verification::verification.fields.expires_at'))
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label(__('dashboard.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => __('verification::verification.statuses.pending'),
                        'verified' => __('verification::verification.statuses.verified'),
                        'expired' => __('verification::verification.statuses.expired'),
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}

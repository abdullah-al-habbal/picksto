<?php

declare(strict_types=1);

namespace Modules\Referral\Filament\Admin\Resources\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
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

                TextColumn::make('status')
                    ->label(__('referral::referral.fields.status'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'claimed' => 'success',
                        'pending' => 'warning',
                        'expired' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('earned_at')
                    ->label(__('referral::referral.fields.earned_at'))
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
                        'pending' => __('referral::referral.statuses.pending'),
                        'claimed' => __('referral::referral.statuses.claimed'),
                        'expired' => __('referral::referral.statuses.expired'),
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}

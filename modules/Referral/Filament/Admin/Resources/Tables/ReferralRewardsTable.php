<?php

declare(strict_types=1);

namespace Modules\Referral\Filament\Admin\Resources\Tables;

use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

final class ReferralRewardsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label(__('referral::referral.fields.user'))
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

                TextColumn::make('expires_at')
                    ->label(__('referral::referral.fields.expires_at'))
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('claimed_at')
                    ->label(__('referral::referral.fields.claimed_at'))
                    ->dateTime()
                    ->sortable()
                    ->placeholder('—'),
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
            ])
            ->defaultSort('earned_at', 'desc');
    }
}

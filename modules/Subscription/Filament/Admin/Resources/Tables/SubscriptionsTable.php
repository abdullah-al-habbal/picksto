<?php

declare(strict_types=1);

namespace Modules\Subscription\Filament\Admin\Resources\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

final class SubscriptionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('#ID')
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label(__('subscription::subscription.fields.user'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('package.name')
                    ->label(__('subscription::subscription.fields.package'))
                    ->sortable(),

                TextColumn::make('status')
                    ->label(__('subscription::subscription.fields.status'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'pending' => 'warning',
                        'expired' => 'danger',
                        'cancelled' => 'gray',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('start_date')
                    ->label(__('subscription::subscription.fields.start_date'))
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('end_date')
                    ->label(__('subscription::subscription.fields.end_date'))
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('downloads_today')
                    ->label(__('subscription::subscription.fields.downloads_today'))
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
                        'active' => __('subscription::subscription.statuses.active'),
                        'pending' => __('subscription::subscription.statuses.pending'),
                        'expired' => __('subscription::subscription.statuses.expired'),
                        'cancelled' => __('subscription::subscription.statuses.cancelled'),
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}

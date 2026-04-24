<?php

declare(strict_types=1);

namespace Modules\Subscription\Filament\Admin\Resources\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class SubscriptionsRelationManager extends RelationManager
{
    protected static string $relationship = 'subscriptions';

    protected static ?string $recordTitleAttribute = 'id';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('package.name')
                    ->label(__('dashboard.resources.package.navigation.singular'))
                    ->sortable(),

                TextColumn::make('status')
                    ->label(__('subscriptionrequest::subscriptionrequest.fields.status'))
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'active' => 'success',
                        'pending' => 'warning',
                        'expired' => 'danger',
                        'cancelled' => 'gray',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('start_date')
                    ->label(__('dashboard.fields.created_at'))
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('end_date')
                    ->label(__('dashboard.fields.updated_at'))
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('downloads_today')
                    ->label(__('analytics::analytics.widgets.download_stats.today'))
                    ->sortable(),
            ])
            ->filters([])
            ->headerActions([])
            ->actions([])
            ->bulkActions([]);
    }
}

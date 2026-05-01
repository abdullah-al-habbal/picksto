<?php

declare(strict_types=1);

namespace Modules\SubscriptionRequest\Filament\Client\Tables;

use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

final class MySubscriptionRequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('#')
                    ->sortable(),
                TextColumn::make('package.name')
                    ->label(__('subscriptionrequest::subscriptionrequest.fields.package'))
                    ->sortable(),
                TextColumn::make('status')
                    ->label(__('subscriptionrequest::subscriptionrequest.fields.status'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'completed', 'approved' => 'success',
                        'pending' => 'warning',
                        'rejected' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => __("subscriptionrequest::subscriptionrequest.statuses.{$state}"))
                    ->sortable(),
                TextColumn::make('amount')
                    ->label(__('subscriptionrequest::subscriptionrequest.fields.amount'))
                    ->money('SAR')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label(__('dashboard.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label(__('subscriptionrequest::subscriptionrequest.fields.status'))
                    ->options([
                        'pending' => __('subscriptionrequest::subscriptionrequest.statuses.pending'),
                        'completed' => __('subscriptionrequest::subscriptionrequest.statuses.completed'),
                        'rejected' => __('subscriptionrequest::subscriptionrequest.statuses.rejected'),
                    ]),
            ])
            ->actions([
                ViewAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }
}

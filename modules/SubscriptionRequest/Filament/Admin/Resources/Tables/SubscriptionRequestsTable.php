<?php

declare(strict_types=1);

namespace Modules\SubscriptionRequest\Filament\Admin\Resources\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Modules\SubscriptionRequest\Filament\Admin\Actions\SubscriptionRequestActions;

final class SubscriptionRequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('#ID')
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label(__('subscriptionrequest::subscriptionrequest.fields.user'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('package.name')
                    ->label(__('subscriptionrequest::subscriptionrequest.fields.package'))
                    ->sortable(),

                TextColumn::make('amount')
                    ->label(__('subscriptionrequest::subscriptionrequest.fields.amount'))
                    ->money('SAR')
                    ->sortable(),

                TextColumn::make('status')
                    ->label(__('subscriptionrequest::subscriptionrequest.fields.status'))
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'completed' => 'success',
                        'approved' => 'success',
                        'rejected' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label(__('dashboard.fields.created_at'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => __('subscriptionrequest::subscriptionrequest.statuses.pending'),
                        'approved' => __('subscriptionrequest::subscriptionrequest.statuses.approved'),
                        'rejected' => __('subscriptionrequest::subscriptionrequest.statuses.rejected'),
                        'completed' => __('subscriptionrequest::subscriptionrequest.statuses.completed'),
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                SubscriptionRequestActions::approve(),
                SubscriptionRequestActions::reject(),
                DeleteAction::make(),
            ])
            ->emptyStateHeading(__('subscriptionrequest::subscriptionrequest.labels.no_requests'));
    }
}

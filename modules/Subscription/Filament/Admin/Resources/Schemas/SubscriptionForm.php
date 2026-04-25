<?php

declare(strict_types=1);

namespace Modules\Subscription\Filament\Admin\Resources\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

final class SubscriptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label(__('subscription::subscription.fields.user'))
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),

                Select::make('package_id')
                    ->label(__('subscription::subscription.fields.package'))
                    ->relationship('package', 'name')
                    ->searchable()
                    ->required(),

                Select::make('status')
                    ->label(__('subscription::subscription.fields.status'))
                    ->options([
                        'active' => __('subscription::subscription.statuses.active'),
                        'pending' => __('subscription::subscription.statuses.pending'),
                        'expired' => __('subscription::subscription.statuses.expired'),
                        'cancelled' => __('subscription::subscription.statuses.cancelled'),
                    ])
                    ->required(),

                DateTimePicker::make('start_date')
                    ->label(__('subscription::subscription.fields.start_date'))
                    ->required(),

                DateTimePicker::make('end_date')
                    ->label(__('subscription::subscription.fields.end_date'))
                    ->required(),

                TextInput::make('downloads_today')
                    ->label(__('subscription::subscription.fields.downloads_today'))
                    ->numeric()
                    ->default(0),

                TextInput::make('downloads_month')
                    ->label(__('subscription::subscription.fields.downloads_month'))
                    ->numeric()
                    ->default(0),

                TextInput::make('payment_method')
                    ->label(__('subscription::subscription.fields.payment_method'))
                    ->placeholder('manual'),

                TextInput::make('transaction_id')
                    ->label(__('subscription::subscription.fields.transaction_id')),
            ]);
    }
}

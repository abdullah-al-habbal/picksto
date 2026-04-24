<?php

declare(strict_types=1);

namespace Modules\SubscriptionRequest\Filament\Admin\Resources\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

final class SubscriptionRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label(__('subscriptionrequest::subscriptionrequest.fields.user'))
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),

                Select::make('package_id')
                    ->label(__('subscriptionrequest::subscriptionrequest.fields.package'))
                    ->relationship('package', 'name')
                    ->searchable()
                    ->required(),

                Select::make('gateway_id')
                    ->label(__('subscriptionrequest::subscriptionrequest.fields.gateway'))
                    ->relationship('gateway', 'name')
                    ->searchable(),

                TextInput::make('amount')
                    ->label(__('subscriptionrequest::subscriptionrequest.fields.amount'))
                    ->numeric()
                    ->prefix('SAR')
                    ->required(),

                TextInput::make('transaction_id')
                    ->label(__('subscriptionrequest::subscriptionrequest.fields.transaction_id'))
                    ->maxLength(255),

                Select::make('status')
                    ->label(__('subscriptionrequest::subscriptionrequest.fields.status'))
                    ->options([
                        'pending' => __('subscriptionrequest::subscriptionrequest.statuses.pending'),
                        'approved' => __('subscriptionrequest::subscriptionrequest.statuses.approved'),
                        'rejected' => __('subscriptionrequest::subscriptionrequest.statuses.rejected'),
                        'completed' => __('subscriptionrequest::subscriptionrequest.statuses.completed'),
                    ])
                    ->required(),

                Textarea::make('user_notes')
                    ->label(__('subscriptionrequest::subscriptionrequest.fields.user_notes'))
                    ->columnSpanFull(),

                Textarea::make('admin_notes')
                    ->label(__('subscriptionrequest::subscriptionrequest.fields.admin_notes'))
                    ->columnSpanFull(),
            ]);
    }
}

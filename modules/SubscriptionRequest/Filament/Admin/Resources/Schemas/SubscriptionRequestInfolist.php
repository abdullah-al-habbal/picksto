<?php

declare(strict_types=1);

namespace Modules\SubscriptionRequest\Filament\Admin\Resources\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

final class SubscriptionRequestInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name')
                    ->label(__('subscriptionrequest::subscriptionrequest.fields.user')),

                TextEntry::make('package.name')
                    ->label(__('subscriptionrequest::subscriptionrequest.fields.package')),

                TextEntry::make('gateway.name')
                    ->label(__('subscriptionrequest::subscriptionrequest.fields.gateway'))
                    ->placeholder('-'),

                TextEntry::make('amount')
                    ->label(__('subscriptionrequest::subscriptionrequest.fields.amount'))
                    ->money('SAR'),

                TextEntry::make('transaction_id')
                    ->label(__('subscriptionrequest::subscriptionrequest.fields.transaction_id'))
                    ->placeholder('-'),

                TextEntry::make('status')
                    ->label(__('subscriptionrequest::subscriptionrequest.fields.status'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'completed' => 'success',
                        'approved' => 'success',
                        'rejected' => 'danger',
                        default => 'gray',
                    }),

                TextEntry::make('user_notes')
                    ->label(__('subscriptionrequest::subscriptionrequest.fields.user_notes'))
                    ->columnSpanFull(),

                TextEntry::make('admin_notes')
                    ->label(__('subscriptionrequest::subscriptionrequest.fields.admin_notes'))
                    ->columnSpanFull(),

                TextEntry::make('approver.name')
                    ->label(__('subscriptionrequest::subscriptionrequest.fields.approved_by'))
                    ->placeholder('-'),

                TextEntry::make('approved_at')
                    ->label(__('subscriptionrequest::subscriptionrequest.fields.approved_at'))
                    ->dateTime()
                    ->placeholder('-'),

                TextEntry::make('created_at')
                    ->label(__('dashboard.fields.created_at'))
                    ->dateTime(),
            ]);
    }
}

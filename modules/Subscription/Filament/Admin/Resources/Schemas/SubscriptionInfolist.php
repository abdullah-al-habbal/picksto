<?php

declare(strict_types=1);

namespace Modules\Subscription\Filament\Admin\Resources\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

final class SubscriptionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name')
                    ->label(__('subscription::subscription.fields.user')),

                TextEntry::make('package.name')
                    ->label(__('subscription::subscription.fields.package')),

                TextEntry::make('status')
                    ->label(__('subscription::subscription.fields.status'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'pending' => 'warning',
                        'expired' => 'danger',
                        'cancelled' => 'gray',
                        default => 'gray',
                    }),

                TextEntry::make('start_date')
                    ->label(__('subscription::subscription.fields.start_date'))
                    ->dateTime(),

                TextEntry::make('end_date')
                    ->label(__('subscription::subscription.fields.end_date'))
                    ->dateTime(),

                TextEntry::make('downloads_today')
                    ->label(__('subscription::subscription.fields.downloads_today')),

                TextEntry::make('downloads_month')
                    ->label(__('subscription::subscription.fields.downloads_month')),

                TextEntry::make('payment_method')
                    ->label(__('subscription::subscription.fields.payment_method')),

                TextEntry::make('transaction_id')
                    ->label(__('subscription::subscription.fields.transaction_id')),

                TextEntry::make('created_at')
                    ->label(__('dashboard.fields.created_at'))
                    ->dateTime(),
            ]);
    }
}

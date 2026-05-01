<?php

declare(strict_types=1);

namespace Modules\SubscriptionRequest\Filament\Client\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class MySubscriptionRequestInfolist
{
    public static function configure(Schema $infolist): Schema
    {
        return $infolist
            ->schema([
                Section::make(__('subscriptionrequest::subscriptionrequest.labels.singular'))
                    ->schema([
                        TextEntry::make('id')
                            ->label('#'),
                        TextEntry::make('package.name')
                            ->label(__('subscriptionrequest::subscriptionrequest.fields.package')),
                        TextEntry::make('status')
                            ->label(__('subscriptionrequest::subscriptionrequest.fields.status'))
                            ->badge()
                            ->color(fn(string $state): string => match ($state) {
                                'completed', 'approved' => 'success',
                                'pending' => 'warning',
                                'rejected' => 'danger',
                                default => 'gray',
                            })
                            ->formatStateUsing(fn(string $state): string => __("subscriptionrequest::subscriptionrequest.statuses.{$state}")),
                        TextEntry::make('amount')
                            ->label(__('subscriptionrequest::subscriptionrequest.fields.amount'))
                            ->money('SAR'),
                        TextEntry::make('user_notes')
                            ->label(__('subscriptionrequest::subscriptionrequest.fields.user_notes'))
                            ->columnSpanFull(),
                        TextEntry::make('admin_notes')
                            ->label(__('subscriptionrequest::subscriptionrequest.fields.admin_notes'))
                            ->columnSpanFull()
                            ->visible(fn($record) => !empty($record->admin_notes)),
                    ])->columns(2),
            ]);
    }
}

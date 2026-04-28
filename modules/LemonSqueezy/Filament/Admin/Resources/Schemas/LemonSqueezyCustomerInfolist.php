<?php

declare(strict_types=1);

namespace Modules\LemonSqueezy\Filament\Admin\Resources\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

final class LemonSqueezyCustomerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id')->label(__('lemonsqueezy::lemonsqueezy.customers.fields.id')),
                TextEntry::make('attributes.email')->label(__('lemonsqueezy::lemonsqueezy.customers.fields.email')),
                TextEntry::make('attributes.name')->label(__('lemonsqueezy::lemonsqueezy.customers.fields.name')),
                TextEntry::make('attributes.status')->label(__('lemonsqueezy::lemonsqueezy.customers.fields.status'))
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'active' => __('lemonsqueezy::lemonsqueezy.customers.status.active'),
                        'inactive' => __('lemonsqueezy::lemonsqueezy.customers.status.inactive'),
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'inactive' => 'warning',
                        default => 'gray',
                    }),
                TextEntry::make('attributes.created_at')->label(__('lemonsqueezy::lemonsqueezy.customers.fields.created_at'))->dateTime(),
            ]);
    }
}

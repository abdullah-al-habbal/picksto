<?php

declare(strict_types=1);

namespace Modules\LemonSqueezy\Filament\Admin\Resources\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

final class LemonSqueezyProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id')->label(__('lemonsqueezy::lemonsqueezy.products.fields.id')),
                TextEntry::make('attributes.name')->label(__('lemonsqueezy::lemonsqueezy.products.fields.name')),
                TextEntry::make('attributes.status')->label(__('lemonsqueezy::lemonsqueezy.products.fields.status'))
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'published' => __('lemonsqueezy::lemonsqueezy.products.status.published'),
                        'draft' => __('lemonsqueezy::lemonsqueezy.products.status.draft'),
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'published' => 'success',
                        'draft' => 'warning',
                        default => 'gray',
                    }),
                TextEntry::make('attributes.created_at')->label(__('lemonsqueezy::lemonsqueezy.products.fields.created_at'))->dateTime(),
            ]);
    }
}

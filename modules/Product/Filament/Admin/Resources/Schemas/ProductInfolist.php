<?php

declare(strict_types=1);

namespace Modules\Product\Filament\Admin\Resources\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Schema;

final class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label(__('dashboard.resources.product.fields.name')),
                TextEntry::make('description')
                    ->label(__('dashboard.resources.product.fields.description'))
                    ->columnSpanFull(),
                TextEntry::make('price')
                    ->label(__('dashboard.resources.product.fields.price'))
                    ->money('SAR'),
                TextEntry::make('currency')
                    ->label(__('dashboard.resources.product.fields.currency')),
                ImageEntry::make('image_url')
                    ->label(__('dashboard.resources.product.fields.image_url')),
                TextEntry::make('is_active')
                    ->label(__('dashboard.resources.product.fields.is_active'))
                    ->badge()
                    ->color(fn (bool $state): string => $state ? 'success' : 'gray'),
                TextEntry::make('sort_order')
                    ->label(__('dashboard.resources.product.fields.sort_order')),
                TextEntry::make('created_at')
                    ->label(__('dashboard.fields.created_at'))
                    ->dateTime(),
            ]);
    }
}

<?php

declare(strict_types=1);

namespace Modules\Product\Filament\Admin\Resources\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

final class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label(__('product::product.fields.name')),

                TextEntry::make('price')
                    ->label(__('product::product.fields.price'))
                    ->money('USD'),

                ImageEntry::make('image')
                    ->label(__('product::product.fields.image')),

                IconEntry::make('is_active')
                    ->label(__('product::product.fields.is_active'))
                    ->boolean(),

                TextEntry::make('description')
                    ->label(__('product::product.fields.description'))
                    ->html()
                    ->columnSpanFull(),

                TextEntry::make('created_at')
                    ->label(__('dashboard.fields.created_at'))
                    ->dateTime(),
            ]);
    }
}

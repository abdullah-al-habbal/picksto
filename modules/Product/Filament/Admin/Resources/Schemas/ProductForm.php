<?php

declare(strict_types=1);

namespace Modules\Product\Filament\Admin\Resources\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

final class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('dashboard.resources.product.fields.name'))
                    ->required()
                    ->maxLength(255),

                Textarea::make('description')
                    ->label(__('dashboard.resources.product.fields.description'))
                    ->maxLength(65535)
                    ->columnSpanFull(),

                TextInput::make('price')
                    ->label(__('dashboard.resources.product.fields.price'))
                    ->numeric()
                    ->required()
                    ->prefix('SAR'),

                TextInput::make('currency')
                    ->label(__('dashboard.resources.product.fields.currency'))
                    ->default('SAR')
                    ->required()
                    ->maxLength(3),

                TextInput::make('image_url')
                    ->label(__('dashboard.resources.product.fields.image_url'))
                    ->url()
                    ->maxLength(255),

                Toggle::make('is_active')
                    ->label(__('dashboard.resources.product.fields.is_active'))
                    ->default(true)
                    ->required(),

                TextInput::make('sort_order')
                    ->label(__('dashboard.resources.product.fields.sort_order'))
                    ->numeric()
                    ->default(0)
                    ->required(),
            ]);
    }
}

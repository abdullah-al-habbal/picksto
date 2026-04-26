<?php

declare(strict_types=1);

namespace Modules\Product\Filament\Admin\Resources\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
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
                    ->label(__('product::product.fields.name'))
                    ->required()
                    ->maxLength(255),

                TextInput::make('price')
                    ->label(__('product::product.fields.price'))
                    ->numeric()
                    ->required(),

                FileUpload::make('image')
                    ->label(__('product::product.fields.image'))
                    ->image()
                    ->directory('products'),

                Toggle::make('is_active')
                    ->label(__('product::product.fields.is_active'))
                    ->default(true),

                RichEditor::make('description')
                    ->label(__('product::product.fields.description'))
                    ->columnSpanFull(),
            ]);
    }
}

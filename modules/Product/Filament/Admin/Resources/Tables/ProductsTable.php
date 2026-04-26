<?php

declare(strict_types=1);

namespace Modules\Product\Filament\Admin\Resources\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label(__('product::product.fields.image')),

                TextColumn::make('name')
                    ->label(__('product::product.fields.name'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('price')
                    ->label(__('product::product.fields.price'))
                    ->money('USD')
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label(__('product::product.fields.is_active'))
                    ->boolean()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label(__('dashboard.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}

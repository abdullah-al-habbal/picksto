<?php

declare(strict_types=1);

namespace Modules\Product\Filament\Admin\Resources\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

final class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('dashboard.resources.product.fields.name'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('price')
                    ->label(__('dashboard.resources.product.fields.price'))
                    ->money('SAR')
                    ->sortable(),

                ToggleColumn::make('is_active')
                    ->label(__('dashboard.resources.product.fields.is_active'))
                    ->sortable(),

                TextColumn::make('sort_order')
                    ->label(__('dashboard.resources.product.fields.sort_order'))
                    ->numeric()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label(__('dashboard.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading(__('dashboard.resources.product.empty_state'));
    }
}

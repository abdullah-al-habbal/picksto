<?php

declare(strict_types=1);

namespace Modules\LemonSqueezy\Filament\Admin\Resources\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class LemonSqueezyProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label(__('lemonsqueezy::lemonsqueezy.products.fields.id'))
                    ->sortable(),
                TextColumn::make('attributes.name')
                    ->label(__('lemonsqueezy::lemonsqueezy.products.fields.name'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('attributes.status')
                    ->label(__('lemonsqueezy::lemonsqueezy.products.fields.status'))
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
                TextColumn::make('attributes.created_at')
                    ->label(__('lemonsqueezy::lemonsqueezy.products.fields.created_at'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([])
            ->actions([])
            ->bulkActions([]);
    }
}

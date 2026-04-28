<?php

declare(strict_types=1);

namespace Modules\LemonSqueezy\Filament\Admin\Resources\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class LemonSqueezyCustomersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label(__('lemonsqueezy::lemonsqueezy.customers.fields.id'))
                    ->sortable(),
                TextColumn::make('attributes.email')
                    ->label(__('lemonsqueezy::lemonsqueezy.customers.fields.email'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('attributes.name')
                    ->label(__('lemonsqueezy::lemonsqueezy.customers.fields.name'))
                    ->sortable(),
                TextColumn::make('attributes.status')
                    ->label(__('lemonsqueezy::lemonsqueezy.customers.fields.status'))
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
                TextColumn::make('attributes.created_at')
                    ->label(__('lemonsqueezy::lemonsqueezy.customers.fields.created_at'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([])
            ->actions([])
            ->bulkActions([]);
    }
}

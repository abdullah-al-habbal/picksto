<?php

declare(strict_types=1);

namespace Modules\Subscription\Filament\Client\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SubscriptionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('package.name')
                    ->label('Package')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'pending' => 'warning',
                        'cancelled' => 'danger',
                        'expired' => 'gray',
                        default => 'gray',
                    }),
                TextColumn::make('startDate')
                    ->label('Start Date')
                    ->dateTime('M d, Y')
                    ->sortable(),
                TextColumn::make('endDate')
                    ->label('End Date')
                    ->dateTime('M d, Y')
                    ->sortable(),
                TextColumn::make('renewalDate')
                    ->label('Renewal Date')
                    ->dateTime('M d, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated([10, 25, 50]);
    }
}

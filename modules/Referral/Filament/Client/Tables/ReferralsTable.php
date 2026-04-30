<?php

declare(strict_types=1);

namespace Modules\Referral\Filament\Client\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ReferralsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('referred.name')
                    ->label('Referred User')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('referred.email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('registered_at')
                    ->label('Registration Date')
                    ->dateTime('M d, Y')
                    ->sortable(),
            ])
            ->defaultSort('registered_at', 'desc')
            ->paginated([10, 25, 50]);
    }
}

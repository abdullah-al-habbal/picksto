<?php

declare(strict_types=1);

namespace Modules\Referral\Filament\Client\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class ReferralsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('referred.name')
                    ->label(__('referral::referral.fields.referred'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('referred.email')
                    ->label(__('user::user.labels.email'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('registered_at')
                    ->label(__('referral::referral.labels.earned_at'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('registered_at', 'desc')
            ->paginated([10, 25, 50]);
    }
}

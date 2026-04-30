<?php

declare(strict_types=1);

namespace Modules\Subscription\Filament\Client\Pages;

use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Modules\Subscription\Models\Subscription;

final class SubscriptionPage extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-rocket-launch';
    protected static ?string $navigationLabel = 'Subscriptions';
    protected static ?int $navigationSort = 2;
    protected string $view = 'filament.pages.subscription';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Subscription::query()
                    ->where('user_id', auth()->id())
                    ->orderBy('created_at', 'desc')
            )
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

    public static function getNavigationGroup(): ?string
    {
        return 'Billing';
    }
}

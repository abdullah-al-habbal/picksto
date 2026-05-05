<?php

declare(strict_types=1);

namespace Modules\Subscription\Filament\Client\Pages;

use Filament\Pages\Page;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Modules\Subscription\Filament\Client\Tables\SubscriptionsTable;
use Modules\Subscription\Models\SubscriptionModel;
use BackedEnum;
final class SubscriptionPage extends Page implements HasTable
{
    use InteractsWithTable;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationLabel = 'Subscriptions';
    protected static ?int $navigationSort = 2;
    protected string $view = 'subscription::filament.pages.subscription';

    public function table(Table $table): Table
    {
        return SubscriptionsTable::configure($table)
            ->query(
                SubscriptionModel::query()
                    ->where('user_id', auth()->id())
                    ->orderBy('created_at', 'desc')
            );
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Billing';
    }
}

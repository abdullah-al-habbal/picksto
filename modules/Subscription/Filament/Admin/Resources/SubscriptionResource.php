<?php

declare(strict_types=1);

namespace Modules\Subscription\Filament\Admin\Resources;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Modules\Subscription\Filament\Admin\Resources\Pages\CreateSubscription;
use Modules\Subscription\Filament\Admin\Resources\Pages\EditSubscription;
use Modules\Subscription\Filament\Admin\Resources\Pages\ListSubscriptions;
use Modules\Subscription\Filament\Admin\Resources\Pages\ViewSubscription;
use Modules\Subscription\Filament\Admin\Resources\Schemas\SubscriptionForm;
use Modules\Subscription\Filament\Admin\Resources\Schemas\SubscriptionInfolist;
use Modules\Subscription\Filament\Admin\Resources\Tables\SubscriptionsTable;
use Modules\Subscription\Models\SubscriptionModel;

final class SubscriptionResource extends Resource
{
    protected static ?string $model = SubscriptionModel::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-credit-card';

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.navigation.groups.sales');
    }

    public static function getNavigationLabel(): string
    {
        return __('subscription::subscription.labels.subscriptions');
    }

    public static function getModelLabel(): string
    {
        return __('subscription::subscription.labels.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('subscription::subscription.labels.plural');
    }

    public static function getRecordTitle(?Model $record): string
    {
        if (! $record) {
            return static::getModelLabel();
        }

        return '#' . $record->id . ' – ' . ($record->user?->name ?? '');
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) cache()->remember('filament.resource.subscription.count', now()->addMinutes(5), fn () => static::getModel()::count());
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'success';
    }

    public static function form(Schema $schema): Schema
    {
        return SubscriptionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SubscriptionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SubscriptionsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSubscriptions::route('/'),
            'create' => CreateSubscription::route('/create'),
            'view' => ViewSubscription::route('/{record}'),
            'edit' => EditSubscription::route('/{record}/edit'),
        ];
    }
}

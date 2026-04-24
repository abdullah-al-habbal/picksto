<?php

declare(strict_types=1);

namespace Modules\SubscriptionRequest\Filament\Admin\Resources;

use Filament\Resources\Resource;
use Modules\SubscriptionRequest\Models\SubscriptionRequestModel;
use Modules\SubscriptionRequest\Filament\Admin\Resources\Pages\ListSubscriptionRequests;
use Modules\SubscriptionRequest\Filament\Admin\Resources\Tables\SubscriptionRequestsTable;

final class SubscriptionRequestResource extends Resource
{
    protected static ?string $model = SubscriptionRequestModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.navigation.groups.sales');
    }

    public static function getNavigationLabel(): string
    {
        return __('subscriptionrequest::subscriptionrequest.labels.requests');
    }

    public static function table(\Filament\Tables\Table $table): \Filament\Tables\Table
    {
        return SubscriptionRequestsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSubscriptionRequests::route('/'),
        ];
    }
}

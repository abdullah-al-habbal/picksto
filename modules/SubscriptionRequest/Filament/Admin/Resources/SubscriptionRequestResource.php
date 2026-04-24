<?php

declare(strict_types=1);

namespace Modules\SubscriptionRequest\Filament\Admin\Resources;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Modules\SubscriptionRequest\Filament\Admin\Resources\Pages\ListSubscriptionRequests;
use Modules\SubscriptionRequest\Filament\Admin\Resources\Pages\ViewSubscriptionRequest;
use Modules\SubscriptionRequest\Filament\Admin\Resources\Schemas\SubscriptionRequestForm;
use Modules\SubscriptionRequest\Filament\Admin\Resources\Schemas\SubscriptionRequestInfolist;
use Modules\SubscriptionRequest\Filament\Admin\Resources\Tables\SubscriptionRequestsTable;
use Modules\SubscriptionRequest\Models\SubscriptionRequestModel;

final class SubscriptionRequestResource extends Resource
{
    protected static ?string $model = SubscriptionRequestModel::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-banknotes';

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.navigation.groups.sales');
    }

    public static function getNavigationLabel(): string
    {
        return __('subscriptionrequest::subscriptionrequest.labels.requests');
    }

    public static function form(Schema $schema): Schema
    {
        return SubscriptionRequestForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SubscriptionRequestInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SubscriptionRequestsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSubscriptionRequests::route('/'),
            'view' => ViewSubscriptionRequest::route('/{record}'),
        ];
    }
}

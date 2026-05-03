<?php

declare(strict_types=1);

namespace Modules\SubscriptionRequest\Filament\Client\Resources;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Modules\SubscriptionRequest\Filament\Client\Resources\Pages\ListMySubscriptionRequests;
use Modules\SubscriptionRequest\Filament\Client\Resources\Pages\ViewMySubscriptionRequest;
use Modules\SubscriptionRequest\Filament\Client\Schemas\MySubscriptionRequestInfolist;
use Modules\SubscriptionRequest\Filament\Client\Tables\MySubscriptionRequestsTable;
use Modules\SubscriptionRequest\Models\SubscriptionRequestModel;
use Filament\Schemas\Schema;


final class MySubscriptionRequestResource extends Resource
{
    protected static ?string $model = SubscriptionRequestModel::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-magnifying-glass';

    public static function getNavigationLabel(): string
    {
        return __('subscriptionrequest::subscriptionrequest.labels.requests');
    }

    public static function getModelLabel(): string
    {
        return __('subscriptionrequest::subscriptionrequest.labels.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('subscriptionrequest::subscriptionrequest.labels.plural');
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->id());
    }

    public static function table(Table $table): Table
    {
        return MySubscriptionRequestsTable::configure($table);
    }

    public static function infolist(Schema $infolist): Schema
    {
        return MySubscriptionRequestInfolist::configure($infolist);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMySubscriptionRequests::route('/'),
            'view' => ViewMySubscriptionRequest::route('/{record}'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.navigation.groups.subscriptions');
    }
}

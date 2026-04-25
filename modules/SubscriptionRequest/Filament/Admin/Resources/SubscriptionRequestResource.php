<?php

declare(strict_types=1);

namespace Modules\SubscriptionRequest\Filament\Admin\Resources;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Modules\SubscriptionRequest\Filament\Admin\Resources\Pages\CreateSubscriptionRequest;
use Modules\SubscriptionRequest\Filament\Admin\Resources\Pages\EditSubscriptionRequest;
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

    public static function getModelLabel(): string
    {
        return __('subscriptionrequest::subscriptionrequest.labels.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('subscriptionrequest::subscriptionrequest.labels.plural');
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
        return (string) cache()->remember('filament.resource.subreq.count', now()->addMinutes(5), fn () => static::getModel()::count());
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'danger';
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
            'create' => CreateSubscriptionRequest::route('/create'),
            'view' => ViewSubscriptionRequest::route('/{record}'),
            'edit' => EditSubscriptionRequest::route('/{record}/edit'),
        ];
    }
}

<?php

declare(strict_types=1);

namespace Modules\LemonSqueezy\Filament\Admin\Resources;

use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Modules\LemonSqueezy\Filament\Admin\Resources\Pages\ListLemonSqueezyCustomers;
use Modules\LemonSqueezy\Filament\Admin\Resources\Pages\ViewLemonSqueezyCustomer;
use Modules\LemonSqueezy\Filament\Admin\Resources\Schemas\LemonSqueezyCustomerForm;
use Modules\LemonSqueezy\Filament\Admin\Resources\Schemas\LemonSqueezyCustomerInfolist;
use Modules\LemonSqueezy\Filament\Admin\Resources\Tables\LemonSqueezyCustomersTable;

final class LemonSqueezyCustomerResource extends Resource
{
    protected static ?string $model = null;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-users';

    public static function getNavigationGroup(): ?string
    {
        return __('lemonsqueezy::lemonsqueezy.navigation.group');
    }

    protected static ?int $navigationSort = 51;

    public static function getNavigationLabel(): string
    {
        return __('lemonsqueezy::lemonsqueezy.customers.labels.navigation');
    }

    public static function getModelLabel(): string
    {
        return __('lemonsqueezy::lemonsqueezy.customers.labels.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('lemonsqueezy::lemonsqueezy.customers.labels.plural');
    }

    public static function form(Schema $schema): Schema
    {
        return LemonSqueezyCustomerForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LemonSqueezyCustomerInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LemonSqueezyCustomersTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLemonSqueezyCustomers::route('/'),
            'view' => ViewLemonSqueezyCustomer::route('/{record}'),
        ];
    }
}

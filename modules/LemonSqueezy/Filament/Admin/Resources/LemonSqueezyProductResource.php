<?php

declare(strict_types=1);

namespace Modules\LemonSqueezy\Filament\Admin\Resources;

use BackedEnum;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Modules\LemonSqueezy\Filament\Admin\Resources\Pages\ListLemonSqueezyProducts;
use Modules\LemonSqueezy\Filament\Admin\Resources\Pages\ViewLemonSqueezyProduct;
use Modules\LemonSqueezy\Filament\Admin\Resources\Schemas\LemonSqueezyProductForm;
use Modules\LemonSqueezy\Filament\Admin\Resources\Schemas\LemonSqueezyProductInfolist;
use Modules\LemonSqueezy\Filament\Admin\Resources\Tables\LemonSqueezyProductsTable;

final class LemonSqueezyProductResource extends Resource
{
    protected static ?string $model = null;
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-shopping-bag';

    public static function getNavigationGroup(): ?string
    {
        return __('lemonsqueezy::lemonsqueezy.navigation.group');
    }

    protected static ?int $navigationSort = 50;

    public static function getNavigationLabel(): string
    {
        return __('lemonsqueezy::lemonsqueezy.products.labels.navigation');
    }

    public static function getModelLabel(): string
    {
        return __('lemonsqueezy::lemonsqueezy.products.labels.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('lemonsqueezy::lemonsqueezy.products.labels.plural');
    }

    public static function getRecordTitle(?Model $record): string
    {
        if (!$record) {
            return static::getModelLabel();
        }

        return $record->name ?? (string) $record->id;
    }

    public static function getNavigationBadge(): ?string
    {
        return null;
    }

    public static function form(Schema $schema): Schema
    {
        return LemonSqueezyProductForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LemonSqueezyProductInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LemonSqueezyProductsTable::configure($table);
    }


    public static function getPages(): array
    {
        return [
            'index' => ListLemonSqueezyProducts::route('/'),
            'view' => ViewLemonSqueezyProduct::route('/{record}'),
        ];
    }
}

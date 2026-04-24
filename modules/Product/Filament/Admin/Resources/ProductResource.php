<?php

declare(strict_types=1);

namespace Modules\Product\Filament\Admin\Resources;

use BackedEnum;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Filament\Admin\Resources\Pages\CreateProduct;
use Modules\Product\Filament\Admin\Resources\Pages\EditProduct;
use Modules\Product\Filament\Admin\Resources\Pages\ListProducts;
use Modules\Product\Filament\Admin\Resources\Pages\ViewProduct;
use Modules\Product\Filament\Admin\Resources\Schemas\ProductForm;
use Modules\Product\Filament\Admin\Resources\Schemas\ProductInfolist;
use Modules\Product\Filament\Admin\Resources\Tables\ProductsTable;
use Modules\Product\Models\ProductModel;

class ProductResource extends Resource
{
    use Translatable;

    protected ?string $model = ProductModel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShoppingBag;

    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.navigation.groups.content');
    }

    public static function getNavigationLabel(): string
    {
        return __('dashboard.resources.product.navigation.label');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.resources.product.navigation.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('dashboard.resources.product.navigation.plural');
    }

    public static function getRecordTitle(?Model $record): string
    {
        if (!$record) {
            return static::getModelLabel();
        }

        return $record->name ?? '#' . $record->id;
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) cache()->remember('filament.resource.product.count', now()->addMinutes(5), fn() => static::getModel()::count());
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'primary';
    }

    public static function form(Schema $schema): Schema
    {
        return ProductForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProductInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProducts::route('/'),
            'create' => CreateProduct::route('/create'),
            'view' => ViewProduct::route('/{record}'),
            'edit' => EditProduct::route('/{record}/edit'),
        ];
    }
}

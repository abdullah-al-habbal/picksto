<?php

declare(strict_types=1);

namespace Modules\Product\Filament\Admin\Resources;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;
use Modules\Product\Filament\Admin\Resources\Pages\CreateProduct;
use Modules\Product\Filament\Admin\Resources\Pages\EditProduct;
use Modules\Product\Filament\Admin\Resources\Pages\ListProducts;
use Modules\Product\Filament\Admin\Resources\Pages\ViewProduct;
use Modules\Product\Filament\Admin\Resources\Schemas\ProductForm;
use Modules\Product\Filament\Admin\Resources\Schemas\ProductInfolist;
use Modules\Product\Filament\Admin\Resources\Tables\ProductsTable;
use Modules\Product\Models\ProductModel;

final class ProductResource extends Resource
{
    use Translatable;

    protected static ?string $model = ProductModel::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-shopping-bag';

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.navigation.groups.sales');
    }

    public static function getNavigationLabel(): string
    {
        return __('product::product.labels.products');
    }

    public static function getModelLabel(): string
    {
        return __('product::product.labels.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('product::product.labels.plural');
    }

    public static function getRecordTitle(?Model $record): string
    {
        if (! $record) {
            return static::getModelLabel();
        }

        return $record->name ?? '#'.$record->id;
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) cache()->remember('filament.resource.product.count', now()->addMinutes(5), fn () => static::getModel()::count());
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

<?php

declare(strict_types=1);

namespace Modules\Package\Filament\Admin\Resources;

use Modules\Package\Filament\Admin\Resources\Pages\CreatePackage;
use Modules\Package\Filament\Admin\Resources\Pages\EditPackage;
use Modules\Package\Filament\Admin\Resources\Pages\ListPackages;
use Modules\Package\Filament\Admin\Resources\Schemas\PackageForm;
use Modules\Package\Filament\Admin\Resources\Tables\PackagesTable;
use Modules\Package\Models\PackageModel;
use BackedEnum;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PackageResource extends Resource
{
    use Translatable;

    protected static ?string $model = PackageModel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return PackageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PackagesTable::configure($table);
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
            'index' => ListPackages::route('/'),
            'create' => CreatePackage::route('/create'),
            'edit' => EditPackage::route('/{record}/edit'),
        ];
    }
}

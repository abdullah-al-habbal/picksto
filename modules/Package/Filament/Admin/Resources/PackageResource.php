<?php

declare(strict_types=1);

namespace Modules\Package\Filament\Admin\Resources;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;
use Modules\Package\Filament\Admin\Resources\Pages\CreatePackage;
use Modules\Package\Filament\Admin\Resources\Pages\EditPackage;
use Modules\Package\Filament\Admin\Resources\Pages\ListPackages;
use Modules\Package\Filament\Admin\Resources\Schemas\PackageForm;
use Modules\Package\Filament\Admin\Resources\Tables\PackagesTable;
use Modules\Package\Models\PackageModel;
use Modules\Subscription\Filament\Admin\Resources\RelationManagers\SubscriptionsRelationManager;

class PackageResource extends Resource
{
    use Translatable;

    protected static ?string $model = PackageModel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.navigation.groups.subscriptions');
    }

    public static function getNavigationLabel(): string
    {
        return __('dashboard.resources.package.navigation.label');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.resources.package.navigation.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('dashboard.resources.package.navigation.plural');
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
        return (string) cache()->remember('filament.resource.package.count', now()->addMinutes(5), fn () => static::getModel()::count());
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'primary';
    }

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
            SubscriptionsRelationManager::class,
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

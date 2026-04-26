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
use Modules\Package\Filament\Admin\Resources\Pages\ViewPackage;
use Modules\Package\Filament\Admin\Resources\Schemas\PackageInfolist;

class PackageResource extends Resource
{
    use Translatable;

    protected static ?string $model = PackageModel::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.navigation.groups.subscriptions');
    }

    public static function getNavigationLabel(): string
    {
        return __('package::package.labels.packages');
    }

    public static function getModelLabel(): string
    {
        return __('package::package.labels.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('package::package.labels.plural');
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

    public static function infolist(Schema $schema): Schema
    {
        return PackageInfolist::configure($schema);
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
            'view' => ViewPackage::route('/{record}'),
            'edit' => EditPackage::route('/{record}/edit'),
        ];
    }
}

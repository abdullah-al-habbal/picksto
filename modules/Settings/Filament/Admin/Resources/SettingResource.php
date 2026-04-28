<?php

declare(strict_types=1);

namespace Modules\Settings\Filament\Admin\Resources;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Modules\Settings\Filament\Admin\Resources\Pages\CreateSetting;
use Modules\Settings\Filament\Admin\Resources\Pages\EditSetting;
use Modules\Settings\Filament\Admin\Resources\Pages\ListSettings;
use Modules\Settings\Filament\Admin\Resources\Pages\ViewSetting;
use Modules\Settings\Filament\Admin\Resources\Schemas\SettingForm;
use Modules\Settings\Filament\Admin\Resources\Schemas\SettingInfolist;
use Modules\Settings\Filament\Admin\Resources\Tables\SettingsTable;
use Modules\Settings\Models\SettingModel;

final class SettingResource extends Resource
{
    protected static ?string $model = SettingModel::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.navigation.groups.settings');
    }

    public static function getNavigationLabel(): string
    {
        return __('settings::settings.labels.settings');
    }

    public static function getModelLabel(): string
    {
        return __('settings::settings.labels.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('settings::settings.labels.plural');
    }

    public static function getRecordTitle(?Model $record): string
    {
        if (! $record) {
            return static::getModelLabel();
        }

        return $record->key;
    }

    public static function form(Schema $schema): Schema
    {
        return SettingForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SettingInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SettingsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSettings::route('/'),
            'create' => CreateSetting::route('/create'),
            'view' => ViewSetting::route('/{record}'),
            'edit' => EditSetting::route('/{record}/edit'),
        ];
    }
}

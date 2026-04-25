<?php

declare(strict_types=1);

namespace Modules\Currency\Filament\Admin\Resources;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Modules\Currency\Filament\Admin\Resources\Pages\CreateCurrencySetting;
use Modules\Currency\Filament\Admin\Resources\Pages\EditCurrencySetting;
use Modules\Currency\Filament\Admin\Resources\Pages\ListCurrencySettings;
use Modules\Currency\Filament\Admin\Resources\Pages\ViewCurrencySetting;
use Modules\Currency\Filament\Admin\Resources\Schemas\CurrencySettingForm;
use Modules\Currency\Filament\Admin\Resources\Schemas\CurrencySettingInfolist;
use Modules\Currency\Filament\Admin\Resources\Tables\CurrencySettingsTable;
use Modules\Currency\Models\CurrencySettingModel;

final class CurrencySettingResource extends Resource
{
    protected static ?string $model = CurrencySettingModel::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-currency-dollar';

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.navigation.groups.settings');
    }

    public static function getNavigationLabel(): string
    {
        return __('currency::currency.labels.currencies');
    }

    public static function getModelLabel(): string
    {
        return __('currency::currency.labels.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('currency::currency.labels.plural');
    }

    public static function getRecordTitle(?Model $record): string
    {
        if (! $record) {
            return static::getModelLabel();
        }

        return $record->name . ' (' . $record->code . ')';
    }

    public static function form(Schema $schema): Schema
    {
        return CurrencySettingForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CurrencySettingInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CurrencySettingsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCurrencySettings::route('/'),
            'create' => CreateCurrencySetting::route('/create'),
            'view' => ViewCurrencySetting::route('/{record}'),
            'edit' => EditCurrencySetting::route('/{record}/edit'),
        ];
    }
}

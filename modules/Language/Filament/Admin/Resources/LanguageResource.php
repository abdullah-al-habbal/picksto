<?php

declare(strict_types=1);

namespace Modules\Language\Filament\Admin\Resources;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\Language\Models\LanguageModel;
use Modules\Language\Filament\Admin\Resources\Pages\CreateLanguage;
use Modules\Language\Filament\Admin\Resources\Pages\EditLanguage;
use Modules\Language\Filament\Admin\Resources\Pages\ListLanguages;
use Modules\Language\Filament\Admin\Resources\Schemas\LanguageForm;
use Modules\Language\Filament\Admin\Resources\Tables\LanguagesTable;

class LanguageResource extends Resource
{
    protected static ?string $model = LanguageModel::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-language';

    protected static ?int $navigationSort = 100;

    public static function getNavigationGroup(): ?string
    {
        return __('Settings');
    }

    public static function form(Schema $schema): Schema
    {
        return LanguageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LanguagesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLanguages::route('/'),
            'create' => CreateLanguage::route('/create'),
            'edit' => EditLanguage::route('/{record}/edit'),
        ];
    }
}

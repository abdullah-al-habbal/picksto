<?php

declare(strict_types=1);

namespace Modules\Verification\Filament\Admin\Resources;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Modules\Verification\Filament\Admin\Resources\Pages\CreateVerificationCode;
use Modules\Verification\Filament\Admin\Resources\Pages\EditVerificationCode;
use Modules\Verification\Filament\Admin\Resources\Pages\ListVerificationCodes;
use Modules\Verification\Filament\Admin\Resources\Pages\ViewVerificationCode;
use Modules\Verification\Filament\Admin\Resources\Schemas\VerificationCodeForm;
use Modules\Verification\Filament\Admin\Resources\Schemas\VerificationCodeInfolist;
use Modules\Verification\Filament\Admin\Resources\Tables\VerificationCodesTable;
use Modules\Verification\Models\VerificationCodeModel;

final class VerificationCodeResource extends Resource
{
    protected static ?string $model = VerificationCodeModel::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-shield-check';

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.navigation.groups.settings');
    }

    public static function getNavigationLabel(): string
    {
        return __('verification::verification.labels.codes');
    }

    public static function getModelLabel(): string
    {
        return __('verification::verification.labels.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('verification::verification.labels.plural');
    }

    public static function getRecordTitle(?Model $record): string
    {
        if (!$record) {
            return static::getModelLabel();
        }

        return $record->code . ' – ' . ($record->user?->name ?? '');
    }

    public static function form(Schema $schema): Schema
    {
        return VerificationCodeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return VerificationCodeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VerificationCodesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListVerificationCodes::route('/'),
            'create' => CreateVerificationCode::route('/create'),
            'view' => ViewVerificationCode::route('/{record}'),
            'edit' => EditVerificationCode::route('/{record}/edit'),
        ];
    }
}

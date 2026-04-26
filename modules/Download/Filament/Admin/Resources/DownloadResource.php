<?php

declare(strict_types=1);

namespace Modules\Download\Filament\Admin\Resources;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Modules\Download\Filament\Admin\Resources\Pages\ListDownloads;
use Modules\Download\Filament\Admin\Resources\Pages\ViewDownload;
use Modules\Download\Filament\Admin\Resources\Schemas\DownloadForm;
use Modules\Download\Filament\Admin\Resources\Schemas\DownloadInfolist;
use Modules\Download\Filament\Admin\Resources\Tables\DownloadsTable;
use Modules\Download\Models\DownloadModel;

final class DownloadResource extends Resource
{
    protected static ?string $model = DownloadModel::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-arrow-down-tray';

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.navigation.groups.sales');
    }

    public static function getNavigationLabel(): string
    {
        return __('download::download.labels.downloads');
    }

    public static function getModelLabel(): string
    {
        return __('download::download.labels.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('download::download.labels.plural');
    }

    public static function getRecordTitle(?Model $record): string
    {
        if (! $record) {
            return static::getModelLabel();
        }

        return $record->file_name;
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) cache()->remember('filament.resource.download.count', now()->addMinutes(5), fn () => static::getModel()::count());
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'success';
    }

    public static function form(Schema $schema): Schema
    {
        return DownloadForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DownloadInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DownloadsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDownloads::route('/'),
            'view' => ViewDownload::route('/{record}'),
        ];
    }
}

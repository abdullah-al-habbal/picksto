<?php

declare(strict_types=1);

namespace Modules\Download\Filament\Client\Pages;

use Filament\Pages\Page;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Modules\Download\Filament\Client\Tables\DownloadsTable;
use Modules\Download\Models\DownloadModel;

final class DownloadsPage extends Page implements HasTable
{
    use InteractsWithTable;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-arrow-down-tray';
    protected static ?string $navigationLabel = 'Downloads';
    protected static ?int $navigationSort = 3;
    protected string $view = 'download::filament.pages.downloads';

    public function table(Table $table): Table
    {
        return DownloadsTable::configure($table)
            ->query(
                DownloadModel::query()
                    ->where('user_id', auth()->id())
                    ->with('product')
                    ->orderBy('created_at', 'desc')
            );
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Content';
    }
}

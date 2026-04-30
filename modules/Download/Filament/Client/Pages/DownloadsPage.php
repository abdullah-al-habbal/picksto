<?php

declare(strict_types=1);

namespace Modules\Download\Filament\Client\Pages;

use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Modules\Download\Models\Download;

final class DownloadsPage extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-down-tray';
    protected static ?string $navigationLabel = 'Downloads';
    protected static ?int $navigationSort = 3;
    protected string $view = 'filament.pages.downloads';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Download::query()
                    ->where('user_id', auth()->id())
                    ->with('product')
                    ->orderBy('created_at', 'desc')
            )
            ->columns([
                TextColumn::make('product.name')
                    ->label('Product')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('fileSize')
                    ->label('File Size')
                    ->formatStateUsing(fn (string $state): string => $this->formatBytes((int) $state))
                    ->sortable(),
                TextColumn::make('downloadCount')
                    ->label('Downloads')
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'completed' => 'success',
                        'pending' => 'warning',
                        'failed' => 'danger',
                        'expired' => 'gray',
                        default => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('createdAt')
                    ->label('Downloaded')
                    ->dateTime('M d, Y H:i')
                    ->sortable(),
                TextColumn::make('expiresAt')
                    ->label('Expires')
                    ->dateTime('M d, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated([10, 25, 50]);
    }

    private function formatBytes(int $bytes, int $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, $precision) . ' ' . $units[$i];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Content';
    }
}

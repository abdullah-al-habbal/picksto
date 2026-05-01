<?php

declare(strict_types=1);

namespace Modules\Download\Filament\Client\Tables;

use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DownloadsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('product.name')
                    ->label(__('download::download.labels.file_name'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('file_size')
                    ->label(__('download::download.fields.file_path'))
                    ->formatStateUsing(fn(?int $state): string => $state ? static::formatBytes($state) : '-')
                    ->sortable(),
                TextColumn::make('status')
                    ->label(__('download::download.fields.status'))
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'completed' => 'success',
                        'pending' => 'warning',
                        'failed' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => __("download::download.statuses.{$state}"))
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label(__('download::download.labels.date'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated([10, 25, 50])
            ->actions([
                Action::make('download')
                    ->label(__('download::download.labels.download'))
                    ->icon('heroicon-m-arrow-down-tray')
                    ->url(fn($record) => route('web.downloads.serve', ['filename' => basename($record->download_path)]))
                    ->openUrlInNewTab()
                    ->visible(fn($record) => $record->status === 'completed'),
            ]);
    }

    private static function formatBytes(int $bytes, int $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, $precision) . ' ' . $units[$i];
    }
}

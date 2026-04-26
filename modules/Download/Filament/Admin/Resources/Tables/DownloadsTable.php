<?php

declare(strict_types=1);

namespace Modules\Download\Filament\Admin\Resources\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

final class DownloadsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label(__('download::download.fields.user'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('file_name')
                    ->label(__('download::download.fields.file_name'))
                    ->searchable()
                    ->limit(30),

                TextColumn::make('site')
                    ->label(__('download::download.fields.site'))
                    ->badge()
                    ->color('gray')
                    ->sortable(),

                TextColumn::make('status')
                    ->label(__('download::download.fields.status'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'completed' => 'success',
                        'pending' => 'warning',
                        'failed' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label(__('dashboard.fields.created_at'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => __('download::download.statuses.pending'),
                        'completed' => __('download::download.statuses.completed'),
                        'failed' => __('download::download.statuses.failed'),
                    ]),
                SelectFilter::make('site')
                    ->options(fn () => \Modules\Download\Models\DownloadModel::query()->distinct()->pluck('site', 'site')->toArray()),
            ])
            ->recordActions([
                ViewAction::make(),
                DeleteAction::make(),
            ]);
    }
}

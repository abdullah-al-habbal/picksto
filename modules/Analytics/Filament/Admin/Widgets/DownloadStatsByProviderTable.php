<?php

declare(strict_types=1);

namespace Modules\Analytics\Filament\Admin\Widgets;

use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Modules\Analytics\Services\DashboardStatsService;
use Modules\Download\Models\DownloadModel;

final class DownloadStatsByProviderTable extends BaseWidget
{
    protected static ?string $heading = 'analytics::analytics.widgets.download_stats.by_provider';

    protected int|string|array $columnSpan = 'full';

    public function getHeading(): ?string
    {
        return __('analytics::analytics.widgets.download_stats.by_provider');
    }

    protected function getTableQuery(): Builder
    {
        return DownloadModel::query()->whereNull('id');
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('provider')
                ->label(__('analytics::analytics.widgets.download_stats.by_provider'))
                ->weight('medium'),
            TextColumn::make('total')
                ->label(__('analytics::analytics.widgets.download_stats.total'))
                ->badge()
                ->color('primary'),
        ];
    }

    public function getTableRecords(): Collection
    {
        $stats = app(DashboardStatsService::class)->getDownloadStats();
        $byProvider = $stats['byProvider'] ?? [];

        return collect($byProvider)->map(fn($count, $provider) => [
            'provider' => $provider,
            'total' => $count,
        ]);
    }
}

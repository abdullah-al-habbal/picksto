<?php

declare(strict_types=1);

namespace Modules\Analytics\Filament\Admin\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Modules\Analytics\Services\DashboardStatsService;

final class DownloadStatsOverview extends BaseWidget
{
    protected ?string $pollingInterval = '30s';

    protected function getStats(): array
    {
        $stats = app(DashboardStatsService::class)->getDownloadStats();

        return [
            Stat::make(
                __('analytics::analytics.widgets.download_stats.today'),
                (string) ($stats['today']['completed'] ?? 0)
            )->description(__('analytics::analytics.widgets.download_stats.total') . ': ' . ($stats['today']['total'] ?? 0)),

            Stat::make(
                __('analytics::analytics.widgets.download_stats.month'),
                (string) ($stats['month']['completed'] ?? 0)
            )->description(__('analytics::analytics.widgets.download_stats.total') . ': ' . ($stats['month']['total'] ?? 0)),

            Stat::make(
                __('analytics::analytics.widgets.download_stats.total'),
                (string) ($stats['total']['completed'] ?? 0)
            )->description(__('analytics::analytics.widgets.download_stats.total') . ': ' . ($stats['total']['total'] ?? 0)),
        ];
    }
}

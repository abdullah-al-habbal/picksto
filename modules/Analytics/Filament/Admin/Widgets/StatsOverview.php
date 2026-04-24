<?php

declare(strict_types=1);

namespace Modules\Analytics\Filament\Admin\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Modules\Analytics\Services\DashboardStatsService;

final class StatsOverview extends StatsOverviewWidget
{
    protected ?string $pollingInterval = '30s';

    protected function getStats(): array
    {
        $stats = app(DashboardStatsService::class)->getOverviewStats();
        $summary = $stats['summary'];

        return [
            Stat::make(__('analytics::analytics.widgets.stats_overview.total_users'), (string) $summary['totalUsers'])
                ->icon('heroicon-o-users')
                ->color('primary'),
            Stat::make(__('analytics::analytics.widgets.stats_overview.active_subscriptions'), (string) $summary['activeSubscriptions'])
                ->icon('heroicon-o-credit-card')
                ->color('success'),
            Stat::make(__('analytics::analytics.widgets.stats_overview.today_downloads'), (string) $summary['todayDownloads'])
                ->icon('heroicon-o-arrow-down-tray')
                ->color('warning'),
            Stat::make(__('analytics::analytics.widgets.stats_overview.estimated_revenue'), '$' . number_format($summary['estimatedRevenue'], 2))
                ->icon('heroicon-o-banknotes')
                ->color('success'),
        ];
    }
}

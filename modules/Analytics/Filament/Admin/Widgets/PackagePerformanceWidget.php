<?php

declare(strict_types=1);

namespace Modules\Analytics\Filament\Admin\Widgets;

use Filament\Widgets\ChartWidget;
use Modules\Analytics\Services\DashboardStatsService;

final class PackagePerformanceWidget extends ChartWidget
{
    public function getHeading(): ?string
    {
        return __('analytics::analytics.widgets.package_performance.heading');
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getData(): array
    {
        $stats = app(DashboardStatsService::class)->getOverviewStats();
        $performance = $stats['packagePerformance'];

        return [
            'datasets' => [
                [
                    'data' => array_column($performance, 'count'),
                    'backgroundColor' => ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6'],
                ],
            ],
            'labels' => array_column($performance, 'name'),
        ];
    }
}

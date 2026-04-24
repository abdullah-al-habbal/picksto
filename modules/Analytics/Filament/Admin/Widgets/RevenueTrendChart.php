<?php

declare(strict_types=1);

namespace Modules\Analytics\Filament\Admin\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;
use Modules\Analytics\Services\DashboardStatsService;

final class RevenueTrendChart extends ChartWidget
{
    protected ?string $pollingInterval = '30s';

    public function getHeading(): ?string
    {
        return __('analytics::analytics.widgets.revenue_trend.heading');
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        $trend = app(DashboardStatsService::class)->getRevenueTrend(30);
        $byDay = $trend['byDay'];

        return [
            'datasets' => [
                [
                    'label' => __('analytics::analytics.widgets.revenue_trend.dataset_label'),
                    'data' => array_column($byDay, 'amount'),
                    'borderColor' => '#10b981',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                    'fill' => true,
                ],
            ],
            'labels' => array_map(fn($day) => Carbon::parse($day['date'])->format('M d'), $byDay),
        ];
    }
}

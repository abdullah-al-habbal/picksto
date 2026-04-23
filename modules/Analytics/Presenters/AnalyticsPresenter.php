<?php

declare(strict_types=1);

namespace Modules\Analytics\Presenters;

final class AnalyticsPresenter
{
    public function presentOverview(array $data): array
    {
        return [
            'summary' => $data['summary'],
            'trafficSources' => $data['trafficSources'],
            'topCountries' => $data['topCountries'],
            'packagePerformance' => $data['packagePerformance'],
            'dailyVisits' => $data['dailyVisits'],
        ];
    }

    public function presentRevenue(array $data): array
    {
        return [
            'total' => $data['total'],
            'averageDaily' => $data['averageDaily'],
            'byDay' => $data['byDay'],
        ];
    }

    public function presentDownloads(array $data): array
    {
        return [
            'today' => $data['today'],
            'month' => $data['month'],
            'total' => $data['total'],
            'byProvider' => $data['byProvider'],
        ];
    }
}

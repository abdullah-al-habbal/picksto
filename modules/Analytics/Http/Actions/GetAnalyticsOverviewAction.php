<?php

declare(strict_types=1);

namespace Modules\Analytics\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Analytics\Presenters\AnalyticsPresenter;
use Modules\Analytics\Services\DashboardStatsService;

final class GetAnalyticsOverviewAction
{
    public function __construct(
        private readonly DashboardStatsService $dashboardStatsService,
        private readonly AnalyticsPresenter $analyticsPresenter,
    ) {
    }

    public function __invoke(): JsonResponse
    {
        $data = $this->dashboardStatsService->getOverviewStats();
        $presented = $this->analyticsPresenter->presentOverview($data);

        return response()->json([
            'success' => true,
            'stats' => $presented,
        ]);
    }
}

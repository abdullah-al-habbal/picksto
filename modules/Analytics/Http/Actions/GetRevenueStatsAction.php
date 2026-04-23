<?php

declare(strict_types=1);

namespace Modules\Analytics\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Analytics\Http\Requests\RevenueStatsRequest;
use Modules\Analytics\Presenters\AnalyticsPresenter;
use Modules\Analytics\Repositories\AnalyticsRepository;

final class GetRevenueStatsAction
{
    public function __construct(
        private readonly AnalyticsRepository $analyticsRepository,
        private readonly AnalyticsPresenter $analyticsPresenter,
    ) {}

    public function __invoke(RevenueStatsRequest $request): JsonResponse
    {
        $period = $request->validated('period');
        $data = $this->analyticsRepository->getRevenueStats($period);
        $presented = $this->analyticsPresenter->presentRevenue($data);

        return response()->json([
            'success' => true,
            'stats' => $presented,
        ]);
    }
}

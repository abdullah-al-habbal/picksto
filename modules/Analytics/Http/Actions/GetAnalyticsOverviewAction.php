<?php

declare(strict_types=1);

namespace Modules\Analytics\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Analytics\Presenters\AnalyticsPresenter;
use Modules\Analytics\Repositories\AnalyticsRepository;

final class GetAnalyticsOverviewAction
{
    public function __construct(
        private readonly AnalyticsRepository $analyticsRepository,
        private readonly AnalyticsPresenter $analyticsPresenter,
    ) {}

    public function __invoke(): JsonResponse
    {
        $data = $this->analyticsRepository->getOverviewStats();
        $presented = $this->analyticsPresenter->presentOverview($data);

        return response()->json([
            'success' => true,
            'stats' => $presented,
        ]);
    }
}

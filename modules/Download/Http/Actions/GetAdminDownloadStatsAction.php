<?php

// modules/Download/Http/Actions/GetAdminDownloadStatsAction.php

declare(strict_types=1);

namespace Modules\Download\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Download\Repositories\DownloadRepository;

final class GetAdminDownloadStatsAction
{
    public function __construct(
        private readonly DownloadRepository $downloadRepository,
    ) {}

    public function __invoke(): JsonResponse
    {
        $today = now()->format('Y-m-d');
        $month = now()->format('Y-m');

        $todayStats = $this->downloadRepository->getStatsForDate($today);
        $monthStats = $this->downloadRepository->getStatsForDate($month);
        $totalStats = $this->downloadRepository->getTotalStats();
        $providerStats = $this->downloadRepository->getStatsByProvider();

        return response()->json([
            'success' => true,
            'stats' => [
                'today' => $todayStats,
                'month' => $monthStats,
                'total' => $totalStats,
                'byProvider' => $providerStats,
            ],
        ]);
    }
}

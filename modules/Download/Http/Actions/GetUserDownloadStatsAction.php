<?php
// modules/Download/Http/Actions/GetUserDownloadStatsAction.php

declare(strict_types=1);

namespace Modules\Download\Http\Actions;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Download\Repositories\DownloadRepository;
use Modules\Subscription\Models\SubscriptionModel;

final class GetUserDownloadStatsAction
{
    public function __construct(
        private readonly DownloadRepository $downloadRepository,
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        $userId = $request->user()->id;

        $today = now()->format('Y-m-d');
        $month = now()->format('Y-m');

        $todayCount = $this->downloadRepository->countCompletedByUserAndDate($userId, $today);
        $monthCount = $this->downloadRepository->countCompletedByUserAndDate($userId, $month);
        $totalCount = $this->downloadRepository->countCompletedByUser($userId);

        $subscription = SubscriptionModel::query()
            ->where('user_id', $userId)
            ->active()
            ->first();

        $dailyLimit = $subscription?->package->daily_limit ?? 10;
        $monthlyLimit = $subscription?->package->monthly_limit ?? 100;

        return response()->json([
            'success' => true,
            'stats' => [
                'today' => $todayCount,
                'thisMonth' => $monthCount,
                'total' => $totalCount,
                'dailyLimit' => $dailyLimit,
                'monthlyLimit' => $monthlyLimit,
                'dailyRemaining' => max(0, $dailyLimit - $todayCount),
                'monthlyRemaining' => max(0, $monthlyLimit - $monthCount),
            ],
        ]);
    }
}

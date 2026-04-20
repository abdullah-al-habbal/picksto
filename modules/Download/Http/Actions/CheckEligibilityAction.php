<?php
// modules/Download/Http/Actions/CheckEligibilityAction.php

declare(strict_types=1);

namespace Modules\Download\Http\Actions;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Download\Repositories\DownloadRepository;
use Modules\Subscription\Models\SubscriptionModel;

final class CheckEligibilityAction
{
    public function __construct(
        private readonly DownloadRepository $downloadRepository,
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        $userId = $request->user()->id;
        $url = $request->get('url');
        $siteSource = $url ? $this->downloadRepository->detectSiteSource($url) : 'Unknown';

        try {
            $this->downloadRepository->checkUserEligibility($userId, $siteSource);

            $subscription = SubscriptionModel::query()
                ->where('user_id', $userId)
                ->active()
                ->first();

            $today = now()->format('Y-m-d');
            $todayUsed = $this->downloadRepository->countCompletedByUserAndDate($userId, $today);

            return response()->json([
                'success' => true,
                'eligible' => true,
                'subscription' => $subscription ? [
                    'packageName' => $subscription->package->name,
                    'dailyLimit' => $subscription->package->daily_limit,
                    'dailyUsed' => $todayUsed,
                    'dailyRemaining' => $subscription->package->daily_limit - $todayUsed,
                ] : null,
            ]);
        } catch (\RuntimeException $e) {
            return response()->json([
                'success' => false,
                'eligible' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}

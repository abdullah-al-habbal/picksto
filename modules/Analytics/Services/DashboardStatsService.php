<?php

declare(strict_types=1);

namespace Modules\Analytics\Services;

use Illuminate\Support\Facades\Cache;
use Modules\Download\Repositories\DownloadRepository;
use Modules\Subscription\Repositories\SubscriptionRepository;
use Modules\User\Repositories\UserRepository;

final class DashboardStatsService
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly SubscriptionRepository $subscriptionRepository,
        private readonly DownloadRepository $downloadRepository,
    ) {}

    public function getOverviewStats(): array
    {
        return Cache::remember('dashboard.overview_stats', now()->addMinutes(15), function () {
            $totalUsers = $this->userRepository->count();
            $activeSubscriptions = $this->subscriptionRepository->countActive();
            $todayDownloads = $this->downloadRepository->countCompletedToday();
            $totalRevenue = $this->subscriptionRepository->getTotalActiveRevenue();

            $packagePerformance = $this->subscriptionRepository->getPackagePerformance();

            return [
                'summary' => [
                    'totalUsers' => $totalUsers,
                    'activeSubscriptions' => $activeSubscriptions,
                    'todayDownloads' => $todayDownloads,
                    'estimatedRevenue' => $totalRevenue,
                ],
                'packagePerformance' => $packagePerformance,
                'trafficSources' => [
                    ['source' => 'Direct', 'count' => 0],
                    ['source' => 'Search', 'count' => 0],
                    ['source' => 'Social', 'count' => 0],
                ],
                'topCountries' => [
                    ['country' => 'SA', 'count' => 0],
                    ['country' => 'EG', 'count' => 0],
                    ['country' => 'US', 'count' => 0],
                ],
                'dailyVisits' => [
                    ['date' => now()->format('Y-m-d'), 'count' => 0],
                ],
            ];
        });
    }

    public function getRevenueTrend(int $days = 30): array
    {
        return Cache::remember("dashboard.revenue_trend_{$days}", now()->addHour(), function () use ($days) {
            $revenueByDay = $this->subscriptionRepository->getRevenueByDay($days);
            $totalRevenue = array_sum(array_column($revenueByDay, 'amount'));
            $averageDaily = $days > 0 ? $totalRevenue / $days : 0;

            return [
                'total' => $totalRevenue,
                'averageDaily' => $averageDaily,
                'byDay' => $revenueByDay,
            ];
        });
    }

    public function getDownloadStats(): array
    {
        return Cache::remember('dashboard.download_stats', now()->addMinutes(30), function () {
            $todayStats = $this->downloadRepository->getStatsForDate(now()->format('Y-m-d'));
            $monthStats = $this->downloadRepository->getStatsForMonth(now()->format('Y-m'));
            $totalStats = $this->downloadRepository->getTotalStats();
            $providerStats = $this->downloadRepository->getStatsByProvider();

            return [
                'today' => $todayStats,
                'month' => $monthStats,
                'total' => $totalStats,
                'byProvider' => $providerStats,
            ];
        });
    }
}

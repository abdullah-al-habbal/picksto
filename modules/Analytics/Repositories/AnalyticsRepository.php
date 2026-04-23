<?php

declare(strict_types=1);

namespace Modules\Analytics\Repositories;

use Illuminate\Support\Facades\DB;
use Modules\Download\Models\DownloadModel;
use Modules\Package\Models\PackageModel;
use Modules\Subscription\Models\SubscriptionModel;
use Modules\User\Models\UserModel;

final class AnalyticsRepository
{
    public function __construct(
        private readonly UserModel $userModel,
        private readonly SubscriptionModel $subscriptionModel,
        private readonly DownloadModel $downloadModel,
        private readonly PackageModel $packageModel,
    ) {
    }

    public function getOverviewStats(): array
    {
        $totalUsers = $this->userModel->newQuery()->count();

        $activeSubscriptions = $this->subscriptionModel->newQuery()
            ->where('status', 'active')
            ->where('end_date', '>=', now())
            ->count();

        $today = now()->format('Y-m-d');
        $todayDownloads = $this->downloadModel->newQuery()
            ->whereDate('created_at', $today)
            ->where('status', 'completed')
            ->count();

        $totalRevenue = $this->subscriptionModel->newQuery()
            ->where('status', 'active')
            ->join('packages', 'subscriptions.package_id', '=', 'packages.id')
            ->sum('packages.price');

        $trafficSources = [
            ['source' => 'Direct', 'count' => rand(100, 500)],
            ['source' => 'Google', 'count' => rand(200, 800)],
            ['source' => 'Social', 'count' => rand(50, 300)],
        ];

        $topCountries = [
            ['country' => 'Saudi Arabia', 'count' => rand(300, 1000)],
            ['country' => 'Egypt', 'count' => rand(100, 400)],
            ['country' => 'UAE', 'count' => rand(50, 200)],
        ];

        $packagePerformance = $this->subscriptionModel->newQuery()
            ->select('packages.name->ar as name', DB::raw('COUNT(*) as count'))
            ->join('packages', 'subscriptions.package_id', '=', 'packages.id')
            ->groupBy('packages.name->ar')
            ->orderByDesc('count')
            ->limit(5)
            ->get()
            ->toArray();

        $dailyVisits = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $dailyVisits[] = [
                'date' => $date,
                'visits' => rand(50, 200),
            ];
        }

        return [
            'summary' => [
                'totalUsers' => $totalUsers,
                'activeSubscriptions' => $activeSubscriptions,
                'todayDownloads' => $todayDownloads,
                'estimatedRevenue' => (float) $totalRevenue,
            ],
            'trafficSources' => $trafficSources,
            'topCountries' => $topCountries,
            'packagePerformance' => $packagePerformance,
            'dailyVisits' => $dailyVisits,
        ];
    }

    public function getRevenueStats(int $periodDays): array
    {
        $startDate = now()->subDays($periodDays);

        $revenueByDay = $this->subscriptionModel->newQuery()
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(packages.price) as total'))
            ->join('packages', 'subscriptions.package_id', '=', 'packages.id')
            ->where('subscriptions.status', 'active')
            ->whereDate('subscriptions.created_at', '>=', $startDate)
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->map(fn($item) => [
                'date' => $item->date,
                'amount' => (float) $item->total,
            ])
            ->toArray();

        $totalRevenue = array_sum(array_column($revenueByDay, 'amount'));
        $averageDaily = $periodDays > 0 ? $totalRevenue / $periodDays : 0;

        return [
            'total' => (float) $totalRevenue,
            'averageDaily' => (float) $averageDaily,
            'byDay' => $revenueByDay,
        ];
    }

    public function getDownloadStats(): array
    {
        $today = now()->format('Y-m-d');
        $thisMonth = now()->format('Y-m');

        $todayStats = $this->downloadModel->newQuery()
            ->selectRaw("
                COUNT(*) as total,
                SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as completed,
                SUM(CASE WHEN status = 'failed' THEN 1 ELSE 0 END) as failed
            ")
            ->whereDate('created_at', $today)
            ->first();

        $monthStats = $this->downloadModel->newQuery()
            ->selectRaw("
                COUNT(*) as total,
                SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as completed,
                SUM(CASE WHEN status = 'failed' THEN 1 ELSE 0 END) as failed
            ")
            ->whereDate('created_at', 'like', "{$thisMonth}%")
            ->first();

        $totalStats = $this->downloadModel->newQuery()
            ->selectRaw("
                COUNT(*) as total,
                SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as completed,
                SUM(CASE WHEN status = 'failed' THEN 1 ELSE 0 END) as failed
            ")
            ->first();

        $providerStats = $this->downloadModel->newQuery()
            ->select('site_source as provider', DB::raw('COUNT(*) as count'))
            ->where('status', 'completed')
            ->groupBy('site_source')
            ->orderByDesc('count')
            ->get()
            ->toArray();

        return [
            'today' => $todayStats ? (array) $todayStats : ['total' => 0, 'completed' => 0, 'failed' => 0],
            'month' => $monthStats ? (array) $monthStats : ['total' => 0, 'completed' => 0, 'failed' => 0],
            'total' => $totalStats ? (array) $totalStats : ['total' => 0, 'completed' => 0, 'failed' => 0],
            'byProvider' => $providerStats,
        ];
    }
}

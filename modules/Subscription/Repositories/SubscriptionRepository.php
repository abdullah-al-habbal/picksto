<?php

// modules/Subscription/Repositories/SubscriptionRepository.php

declare(strict_types=1);

namespace Modules\Subscription\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Modules\Package\Models\PackageModel;
use Modules\Subscription\Models\SubscriptionModel;
use Modules\User\Models\UserModel;

final class SubscriptionRepository
{
    public function __construct(
        private readonly SubscriptionModel $model,
        private readonly PackageModel $packageModel,
        private readonly UserModel $userModel,
    ) {}

    public function create(array $data): SubscriptionModel
    {
        return $this->model->newQuery()->create($data);
    }

    public function purchasePackage(int $userId, int $packageId): array
    {
        $package = $this->packageModel->newQuery()->findOrFail($packageId);
        $user = $this->userModel->newQuery()->findOrFail($userId);

        $existingPending = $this->model->newQuery()
            ->where('user_id', $userId)
            ->where('status', 'pending')
            ->first();

        if ($existingPending) {
            return [
                'status' => 'pending',
                'message' => 'subscription::messages.already_pending',
                'subscription' => $existingPending,
            ];
        }

        $subscription = $this->model->newQuery()->create([
            'user_id' => $userId,
            'package_id' => $packageId,
            'status' => 'active',
            'start_date' => now(),
            'end_date' => now()->addDays($package->duration_days),
            'downloads_today' => 0,
            'downloads_month' => 0,
            'payment_method' => 'manual',
        ]);

        return [
            'status' => 'active',
            'message' => 'subscription::messages.purchase_success',
            'subscription' => $subscription,
        ];
    }

    public function getUserInvoices(int $userId): Collection
    {
        return $this->model->newQuery()
            ->with('package')
            ->byUser($userId)
            ->whereIn('status', ['active', 'expired', 'cancelled'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getPendingCount(): int
    {
        return $this->model->newQuery()
            ->pending()
            ->count();
    }

    public function getUserPending(int $userId): Collection
    {
        return $this->model->newQuery()
            ->with('package')
            ->byUser($userId)
            ->pending()
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getActiveSubscription(int $userId): ?SubscriptionModel
    {
        return $this->model->newQuery()
            ->with('package')
            ->byUser($userId)
            ->active()
            ->latest('start_date')
            ->first();
    }

    public function canUserDownload(int $userId, string $siteSource): bool
    {
        $subscription = $this->getActiveSubscription($userId);

        if (! $subscription) {
            return false;
        }

        $allowedSites = $subscription->package->allowed_sites ?? [];

        return in_array('All', $allowedSites, true)
            || in_array($siteSource, $allowedSites, true);
    }

    public function incrementDownloadCounters(int $subscriptionId): void
    {
        $subscription = $this->model->newQuery()->findOrFail($subscriptionId);
        $subscription->incrementDownloadCounters();
    }

    public function resetDailyCounters(): int
    {
        return $this->model->newQuery()
            ->active()
            ->update(['downloads_today' => 0]);
    }

    public function expireOverdueSubscriptions(): int
    {
        return $this->model->newQuery()
            ->where('status', 'active')
            ->where('end_date', '<', now())
            ->update(['status' => 'expired']);
    }

    public function countActive(): int
    {
        return $this->model->newQuery()
            ->where('status', 'active')
            ->where('end_date', '>=', now())
            ->count();
    }

    public function getTotalActiveRevenue(): float
    {
        return (float) $this->model->newQuery()
            ->where('status', 'active')
            ->join('packages', 'subscriptions.package_id', '=', 'packages.id')
            ->sum('packages.price');
    }

    public function getRevenueByDay(int $periodDays): array
    {
        $startDate = now()->subDays($periodDays);

        return $this->model->newQuery()
            ->select(DB::raw('DATE(subscriptions.created_at) as date'), DB::raw('SUM(packages.price) as total'))
            ->join('packages', 'subscriptions.package_id', '=', 'packages.id')
            ->where('subscriptions.status', 'active')
            ->whereDate('subscriptions.created_at', '>=', $startDate)
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->map(fn ($item) => [
                'date' => $item->date,
                'amount' => (float) $item->total,
            ])
            ->toArray();
    }

    public function getPackagePerformance(): array
    {
        return $this->model->newQuery()
            ->select('packages.name->ar as name', DB::raw('COUNT(*) as count'))
            ->join('packages', 'subscriptions.package_id', '=', 'packages.id')
            ->groupBy('packages.name->ar')
            ->orderByDesc('count')
            ->limit(5)
            ->get()
            ->toArray();
    }
}

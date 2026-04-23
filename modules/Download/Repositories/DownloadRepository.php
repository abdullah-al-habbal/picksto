<?php

// modules/Download/Repositories/DownloadRepository.php

declare(strict_types=1);

namespace Modules\Download\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Download\Models\DownloadModel;
use Modules\Subscription\Models\SubscriptionModel;

final class DownloadRepository
{
    public function __construct(
        private readonly DownloadModel $model,
        private readonly SubscriptionModel $subscriptionModel,
    ) {}

    public function create(array $data): DownloadModel
    {
        return $this->model->newQuery()->create($data);
    }

    public function findByFilenameAndUser(string $filename, int $userId): ?DownloadModel
    {
        return $this->model->newQuery()
            ->where('user_id', $userId)
            ->where('download_path', 'like', "%{$filename}")
            ->first();
    }

    public function getUserDownloads(int $userId): Collection
    {
        return $this->model->newQuery()
            ->byUser($userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getAllWithRelations(): Collection
    {
        return $this->model->newQuery()
            ->with(['user:id,name,email'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function countCompletedByUserAndDate(int $userId, string $date): int
    {
        return $this->model->newQuery()
            ->where('user_id', $userId)
            ->where('status', 'completed')
            ->whereDate('created_at', $date)
            ->count();
    }

    public function countCompletedByUser(int $userId): int
    {
        return $this->model->newQuery()
            ->where('user_id', $userId)
            ->where('status', 'completed')
            ->count();
    }

    public function getStatsForDate(string $date): array
    {
        return $this->model->newQuery()
            ->whereDate('created_at', $date)
            ->selectRaw("
                COUNT(*) as total,
                SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as completed,
                SUM(CASE WHEN status = 'failed' THEN 1 ELSE 0 END) as failed
            ")
            ->first()
            ?->toArray() ?? ['total' => 0, 'completed' => 0, 'failed' => 0];
    }

    public function getTotalStats(): array
    {
        return $this->model->newQuery()
            ->selectRaw("
                COUNT(*) as total,
                SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as completed,
                SUM(CASE WHEN status = 'failed' THEN 1 ELSE 0 END) as failed
            ")
            ->first()
            ?->toArray() ?? ['total' => 0, 'completed' => 0, 'failed' => 0];
    }

    public function getStatsByProvider(): array
    {
        return $this->model->newQuery()
            ->where('status', 'completed')
            ->selectRaw('site_source as provider, COUNT(*) as count')
            ->groupBy('site_source')
            ->pluck('count', 'provider')
            ->toArray();
    }

    public function delete(int $id): bool
    {
        $download = $this->model->newQuery()->findOrFail($id);

        return $download->delete();
    }

    public function checkUserEligibility(int $userId, string $siteSource): void
    {
        $subscription = $this->subscriptionModel->newQuery()
            ->where('user_id', $userId)
            ->active()
            ->first();

        if (! $subscription) {
            throw new \RuntimeException(__('download::errors.no_subscription'));
        }

        $allowedSites = $subscription->package->allowed_sites ?? [];
        $hasAccess = in_array('All', $allowedSites, true) || in_array($siteSource, $allowedSites, true);

        if (! $hasAccess) {
            throw new \RuntimeException(__('download::errors.site_not_supported', ['site' => $siteSource]));
        }

        $today = now()->format('Y-m-d');
        $used = $this->countCompletedByUserAndDate($userId, $today);

        if ($used >= $subscription->package->daily_limit) {
            throw new \RuntimeException(__('download::errors.daily_limit_reached'));
        }
    }

    public function detectSiteSource(string $url): string
    {
        $lowerUrl = strtolower($url);

        return match (true) {
            str_contains($lowerUrl, 'freepik.com') => 'Freepik',
            str_contains($lowerUrl, 'flaticon.com') => 'Flaticon',
            str_contains($lowerUrl, 'envato') || str_contains($lowerUrl, 'elements.envato') => 'Envato Elements',
            str_contains($lowerUrl, 'motionarray.com') => 'MotionArray',
            str_contains($lowerUrl, 'shutterstock.com') => 'Shutterstock',
            str_contains($lowerUrl, 'artlist.io') => 'Artlist',
            str_contains($lowerUrl, 'pikbest.com') => 'Pikbest',
            str_contains($lowerUrl, 'placeit.net') => 'Placeit',
            default => 'Unknown',
        };
    }
}

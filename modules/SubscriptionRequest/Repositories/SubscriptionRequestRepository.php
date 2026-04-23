<?php

// SubscriptionRequest/Repositories/SubscriptionRequestRepository.php

declare(strict_types=1);

namespace Modules\SubscriptionRequest\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\SubscriptionRequest\Models\SubscriptionRequestModel;

final class SubscriptionRequestRepository
{
    public function __construct(
        private readonly SubscriptionRequestModel $model,
    ) {}

    public function create(array $data): SubscriptionRequestModel
    {
        return $this->model->newQuery()->create($data);
    }

    public function findById(int $id): ?SubscriptionRequestModel
    {
        return $this->model->newQuery()->with(['user', 'package', 'gateway'])->find($id);
    }

    public function getAllByStatus(?string $status = null): Collection
    {
        $query = $this->model->newQuery()->with(['user:id,name,email', 'package:id,name,price', 'gateway:id,name']);

        if ($status) {
            $query->where('status', $status);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    public function updateStatus(int $id, string $status, ?int $approvedBy = null): bool
    {
        $request = $this->findById($id);

        if (! $request) {
            return false;
        }

        return $request->update([
            'status' => $status,
            'approved_at' => now(),
            'approved_by' => $approvedBy,
        ]);
    }

    public function getPendingCount(): int
    {
        return $this->model->newQuery()->pending()->count();
    }

    public function getUserPending(int $userId): Collection
    {
        return $this->model->newQuery()
            ->byUser($userId)
            ->pending()
            ->with('package')
            ->orderBy('created_at', 'desc')
            ->get();
    }
}

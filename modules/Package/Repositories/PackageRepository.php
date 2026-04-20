<?php
// modules/Package/Repositories/PackageRepository.php

declare(strict_types=1);

namespace Modules\Package\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Package\Models\PackageModel;
use Illuminate\Database\Eloquent\Collection;
final class PackageRepository
{
    public function __construct(
        private readonly PackageModel $model,
    ) {}

    public function getActivePackages(): Collection
    {
        return $this->model->newQuery()
            ->active()
            ->orderBy('price', 'asc')
            ->get();
    }

    public function getAllWithPagination(int $perPage = 20, ?string $search = null): LengthAwarePaginator
    {
        $query = $this->model->newQuery();

        if ($search) {
            // fix: use the whereAny
            $query->where(static function ($q) use ($search): void {
                $q->where('name_ar', 'like', "%{$search}%")
                    ->orWhere('name_en', 'like', "%{$search}%")
                    ->orWhere('description_ar', 'like', "%{$search}%")
                    ->orWhere('description_en', 'like', "%{$search}%");
            });
        }

        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function findById(int $id): ?PackageModel
    {
        return $this->model->newQuery()->findOrFail($id);
    }

    public function create(array $data): PackageModel
    {
        return $this->model->newQuery()->create([
            'name_ar' => $data['name_ar'],
            'name_en' => $data['name_en'] ?? null,
            'description_ar' => $data['description_ar'] ?? null,
            'description_en' => $data['description_en'] ?? null,
            'price' => $data['price'],
            'currency' => $data['currency'],
            'daily_limit' => $data['daily_limit'],
            'monthly_limit' => $data['monthly_limit'],
            'allowed_sites' => $data['allowed_sites'],
            'duration_days' => $data['duration_days'],
            'is_active' => $data['is_active'] ?? true,
        ]);
    }

    public function update(int $id, array $data): PackageModel
    {
        $package = $this->findById($id);

        $updateData = array_filter([
            'name_ar' => $data['name_ar'] ?? null,
            'name_en' => $data['name_en'] ?? null,
            'description_ar' => $data['description_ar'] ?? null,
            'description_en' => $data['description_en'] ?? null,
            'price' => $data['price'] ?? null,
            'currency' => $data['currency'] ?? null,
            'daily_limit' => $data['daily_limit'] ?? null,
            'monthly_limit' => $data['monthly_limit'] ?? null,
            'allowed_sites' => $data['allowed_sites'] ?? null,
            'duration_days' => $data['duration_days'] ?? null,
            'is_active' => $data['is_active'] ?? null,
        ], static fn ($value) => $value !== null);

        $package->update($updateData);

        return $package->fresh();
    }

    public function delete(int $id): bool
    {
        $package = $this->findById($id);

        return $package->delete();
    }

    public function existsByNameAr(string $nameAr, ?int $excludeId = null): bool
    {
        $query = $this->model->newQuery()->where('name_ar', $nameAr);

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->exists();
    }
}

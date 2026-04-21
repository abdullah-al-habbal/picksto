<?php

// Product/Repositories/ProductRepository.php

declare(strict_types=1);

namespace Modules\Product\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Product\Models\ProductModel;

final class ProductRepository
{
    public function __construct(
        private readonly ProductModel $model,
    ) {}

    public function getActiveProducts(): Collection
    {
        return $this->model->newQuery()->active()->get();
    }

    public function create(array $data): ProductModel
    {
        return $this->model->newQuery()->create([
            'name_ar' => $data['name_ar'],
            'name_en' => $data['name_en'] ?? null,
            'description_ar' => $data['description_ar'] ?? null,
            'description_en' => $data['description_en'] ?? null,
            'price' => $data['price'],
            'currency' => $data['currency'] ?? 'SAR',
            'image_url' => $data['image_url'] ?? null,
            'is_active' => $data['isActive'] ?? true,
            'sort_order' => $data['sortOrder'] ?? 0,
        ]);
    }

    public function update(int $id, array $data): ProductModel
    {
        $product = $this->model->newQuery()->findOrFail($id);

        $updateData = array_filter([
            'name_ar' => $data['name_ar'] ?? null,
            'name_en' => $data['name_en'] ?? null,
            'description_ar' => $data['description_ar'] ?? null,
            'description_en' => $data['description_en'] ?? null,
            'price' => $data['price'] ?? null,
            'currency' => $data['currency'] ?? null,
            'image_url' => $data['image_url'] ?? null,
            'is_active' => $data['isActive'] ?? null,
            'sort_order' => $data['sortOrder'] ?? null,
        ], static fn ($value) => $value !== null);

        $product->update($updateData);

        return $product->fresh();
    }

    public function delete(int $id): bool
    {
        return $this->model->newQuery()->where('id', $id)->delete();
    }
}

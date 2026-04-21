<?php

// Product/Presenters/ProductPresenter.php

declare(strict_types=1);

namespace Modules\Product\Presenters;

use Modules\Product\Models\ProductModel;

final class ProductPresenter
{
    public function present(ProductModel $product): array
    {
        return [
            'id' => $product->id,
            'name' => $product->name,
            'nameAr' => $product->name_ar,
            'nameEn' => $product->name_en,
            'description' => $product->description,
            'descriptionAr' => $product->description_ar,
            'descriptionEn' => $product->description_en,
            'price' => (float) $product->price,
            'currency' => $product->currency,
            'image' => $product->image_url,
            'isActive' => $product->is_active,
            'sortOrder' => $product->sort_order,
            'createdAt' => $product->created_at?->format('Y-m-d'),
        ];
    }
}

<?php
// modules/Package/Presenters/PackagePresenter.php

declare(strict_types=1);

namespace Modules\Package\Presenters;

use Modules\Package\Models\PackageModel;

final class PackagePresenter
{
    public function present(PackageModel $package): array
    {
        return [
            'id' => $package->id,
            'name' => $package->name,
            'nameAr' => $package->name_ar,
            'nameEn' => $package->name_en,
            'description' => $package->description,
            'descriptionAr' => $package->description_ar,
            'descriptionEn' => $package->description_en,
            'price' => (float) $package->price,
            'currency' => $package->currency,
            'dailyLimit' => $package->daily_limit,
            'monthlyLimit' => $package->monthly_limit,
            'allowedSites' => $package->allowed_sites ?? [],
            'durationDays' => $package->duration_days,
            'isActive' => $package->is_active,
            'createdAt' => $package->created_at?->format('Y-m-d'),
            'updatedAt' => $package->updated_at?->format('Y-m-d'),
        ];
    }

    public function presentList(PackageModel $package): array
    {
        return [
            'id' => $package->id,
            'name' => $package->name,
            'price' => (float) $package->price,
            'currency' => $package->currency,
            'dailyLimit' => $package->daily_limit,
            'monthlyLimit' => $package->monthly_limit,
            'durationDays' => $package->duration_days,
            'isActive' => $package->is_active,
        ];
    }
}

<?php

declare(strict_types=1);

namespace Modules\Subscription\Services;

use Modules\Package\Models\PackageModel;
use Modules\Subscription\Models\SubscriptionModel;

final class SubscriptionService
{
    public function activateManualSubscription(int $userId, int $packageId, int $durationDays): bool
    {
        $package = PackageModel::findOrFail($packageId);

        SubscriptionModel::create([
            'user_id'         => $userId,
            'package_id'      => $packageId,
            'status'          => 'active',
            'start_date'      => now(),
            'end_date'        => now()->addDays($durationDays),
            'downloads_today' => 0,
            'downloads_month' => 0,
            'payment_method'  => 'manual',
        ]);

        return true;
    }
}

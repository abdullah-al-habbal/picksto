<?php
// modules/Subscription/Jobs/SendSubscriptionExpiryNotificationJob.php

declare(strict_types=1);

namespace Modules\Subscription\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Subscription\Models\SubscriptionModel;

final class SendSubscriptionExpiryNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public readonly int $subscriptionId,
    ) {}

    public function handle(): void
    {
        SubscriptionModel::with('user')->findOrFail($this->subscriptionId);
    }
}

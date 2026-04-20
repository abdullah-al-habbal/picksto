<?php
// modules/Subscription/Jobs/ResetDailyDownloadCountersJob.php

declare(strict_types=1);

namespace Modules\Subscription\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Subscription\Repositories\SubscriptionRepository;

final class ResetDailyDownloadCountersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private readonly SubscriptionRepository $subscriptionRepository,
    ) {}

    public function handle(): void
    {
        $this->subscriptionRepository->resetDailyCounters();
    }
}

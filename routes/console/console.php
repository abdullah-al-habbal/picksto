<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schedule;
use Modules\Subscription\Jobs\ExpireOverdueSubscriptionsJob;
use Modules\Subscription\Jobs\ResetDailyDownloadCountersJob;
use Modules\Subscription\Repositories\SubscriptionRepository;

Schedule::job(
    new ResetDailyDownloadCountersJob(
        app(SubscriptionRepository::class)
    )
)->dailyAt('00:00')->name('subscription:reset-daily-counters');

Schedule::job(
    new ExpireOverdueSubscriptionsJob(
        app(SubscriptionRepository::class)
    )
)->dailyAt('00:05')->name('subscription:expire-overdue');

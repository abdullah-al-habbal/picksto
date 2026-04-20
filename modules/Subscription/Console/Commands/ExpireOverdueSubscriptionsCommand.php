<?php
// modules/Subscription/Console/Commands/ExpireOverdueSubscriptionsCommand.php

declare(strict_types=1);

namespace Modules\Subscription\Console\Commands;

use Illuminate\Console\Command;
use Modules\Subscription\Jobs\ExpireOverdueSubscriptionsJob;
use Modules\Subscription\Repositories\SubscriptionRepository;

final class ExpireOverdueSubscriptionsCommand extends Command
{
    protected $signature = 'subscription:expire-overdue {--sync : Run synchronously}';
    protected $description = 'Expire overdue subscriptions';

    public function handle(): int
    {
        if ($this->option('sync')) {
            $job = new ExpireOverdueSubscriptionsJob(
                app(SubscriptionRepository::class)
            );
            $job->handle();
            $this->info('Overdue subscriptions expired successfully');
        } else {
            ExpireOverdueSubscriptionsJob::dispatch(
                app(SubscriptionRepository::class)
            );
            $this->info('Expire overdue subscriptions job dispatched');
        }

        return Command::SUCCESS;
    }
}

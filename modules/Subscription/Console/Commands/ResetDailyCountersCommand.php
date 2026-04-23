<?php

// modules/Subscription/Console/Commands/ResetDailyCountersCommand.php

declare(strict_types=1);

namespace Modules\Subscription\Console\Commands;

use Illuminate\Console\Command;
use Modules\Subscription\Jobs\ResetDailyDownloadCountersJob;
use Modules\Subscription\Repositories\SubscriptionRepository;

final class ResetDailyCountersCommand extends Command
{
    protected $signature = 'subscription:reset-daily-counters {--sync : Run synchronously}';

    protected $description = 'Reset daily download counters for all active subscriptions';

    public function handle(): int
    {
        if ($this->option('sync')) {
            $job = new ResetDailyDownloadCountersJob(
                app(SubscriptionRepository::class)
            );
            $job->handle();
            $this->info('Daily counters reset successfully');
        } else {
            ResetDailyDownloadCountersJob::dispatch(
                app(SubscriptionRepository::class)
            );
            $this->info('Daily counters reset job dispatched');
        }

        return Command::SUCCESS;
    }
}

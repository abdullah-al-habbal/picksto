<?php

// SubscriptionRequest/Providers/SubscriptionRequestServiceProvider.php

declare(strict_types=1);

namespace Modules\SubscriptionRequest\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

final class SubscriptionRequestServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Direct instantiation only
    }

    public function boot(): void
    {
        $this->loadMigrations();
    }

    private function loadMigrations(): void
    {
        $path = __DIR__.'/../Database/Migrations';

        if (File::isDirectory($path)) {
            $this->loadMigrationsFrom($path);
        }
    }
}

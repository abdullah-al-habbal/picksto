<?php

// modules/Subscription/Providers/SubscriptionServiceProvider.php

declare(strict_types=1);

namespace Modules\Subscription\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

final class SubscriptionServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        $this->loadRoutes();
        $this->loadMigrations();
        $this->loadTranslations();
        $this->loadViews();
    }

    private function loadRoutes(): void
    {
        $path = __DIR__ . '/../Routes/web.php';

        if (!File::exists($path)) {
            return;
        }

        Route::prefix('web')
            ->name('web.')
            ->middleware(['web'])
            ->group($path);
    }

    private function loadMigrations(): void
    {
        $path = __DIR__ . '/../Database/Migrations';

        if (File::isDirectory($path)) {
            $this->loadMigrationsFrom($path);
        }
    }

    private function loadTranslations(): void
    {
        $path = __DIR__ . '/../lang';

        if (File::isDirectory($path)) {
            $this->loadTranslationsFrom($path, 'subscription');
        }
    }

    private function loadViews(): void
    {
        $path = __DIR__ . '/../resources/views';

        if (File::isDirectory($path)) {
            $this->loadViewsFrom($path, 'subscription');
        }
    }
}

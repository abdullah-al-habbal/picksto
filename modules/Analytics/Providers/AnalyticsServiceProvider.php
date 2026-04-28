<?php

declare(strict_types=1);

namespace Modules\Analytics\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

final class AnalyticsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        $this->loadRoutes();
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

    private function loadTranslations(): void
    {
        $path = __DIR__ . '/../lang';

        if (File::isDirectory($path)) {
            $this->loadTranslationsFrom($path, 'analytics');
        }
    }

    private function loadViews(): void
    {
        $path = __DIR__ . '/../resources/views';

        if (File::isDirectory($path)) {
            $this->loadViewsFrom($path, 'analytics');
        }
    }
}

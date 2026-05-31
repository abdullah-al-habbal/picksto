<?php

declare(strict_types=1);

namespace Modules\Website\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

final class WebsiteServiceProvider extends ServiceProvider
{
    public function register(): void {}

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

        Route::middleware(['web'])->group($path);
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
            $this->loadTranslationsFrom($path, 'website');
        }
    }

    private function loadViews(): void
    {
        $path = __DIR__ . '/../Resources/views';

        if (File::isDirectory($path)) {
            $this->loadViewsFrom($path, 'website');
        }
    }
}

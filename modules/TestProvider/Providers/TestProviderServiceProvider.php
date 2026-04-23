<?php

declare(strict_types=1);

namespace Modules\TestProvider\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

final class TestProviderServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Direct instantiation only - no bindings, no interfaces
    }

    public function boot(): void
    {
        $this->loadRoutes();
        $this->loadTranslations();
    }

    private function loadRoutes(): void
    {
        $path = __DIR__.'/../Routes/web.php';

        if (! File::exists($path)) {
            return;
        }

        Route::prefix('web')
            ->name('web.')
            ->middleware(['web'])
            ->group($path);
    }

    private function loadTranslations(): void
    {
        $path = __DIR__.'/../lang';

        if (File::isDirectory($path)) {
            $this->loadTranslationsFrom($path, 'testprovider');
        }
    }
}

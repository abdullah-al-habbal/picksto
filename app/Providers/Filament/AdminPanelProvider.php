<?php

declare(strict_types=1);

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use LaraZeus\SpatieTranslatable\SpatieTranslatablePlugin;
use Modules\Analytics\Filament\Admin\Widgets\DownloadStatsWidget;
use Modules\Analytics\Filament\Admin\Widgets\PackagePerformanceWidget;
use Modules\Analytics\Filament\Admin\Widgets\RevenueTrendChart;
use Modules\Analytics\Filament\Admin\Widgets\StatsOverview;

final class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        $panel = $panel
            ->default()
            ->id(config('panels.admin.id', 'admin'))
            ->path(config('panels.admin.path', 'admin'))
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->brandName(config('panels.admin.brand', 'Picksto Admin'))
            ->spa()
            ->plugins([
                SpatieTranslatablePlugin::make()
                    ->defaultLocales(['en', 'ar']),
            ])
            ->pages([
                Dashboard::class,
            ])
            ->widgets([
                StatsOverview::class,
                RevenueTrendChart::class,
                PackagePerformanceWidget::class,
                DownloadStatsWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
                'admin',
            ]);

        $modulesPath = base_path('modules');

        if (is_dir($modulesPath)) {
            foreach (scandir($modulesPath) as $module) {
                if ($module === '.' || $module === '..') {
                    continue;
                }

                $moduleDir = $modulesPath . DIRECTORY_SEPARATOR . $module;
                if (!is_dir($moduleDir)) {
                    continue;
                }

                $namespace = "Modules\\{$module}\\Filament\\Admin";

                $resourcesDir = $moduleDir . DIRECTORY_SEPARATOR . 'Filament' . DIRECTORY_SEPARATOR . 'Admin' . DIRECTORY_SEPARATOR . 'Resources';
                if (is_dir($resourcesDir)) {
                    $panel->discoverResources(in: $resourcesDir, for: $namespace . '\\Resources');
                }

                $pagesDir = $moduleDir . DIRECTORY_SEPARATOR . 'Filament' . DIRECTORY_SEPARATOR . 'Admin' . DIRECTORY_SEPARATOR . 'Pages';
                if (is_dir($pagesDir)) {
                    $panel->discoverPages(in: $pagesDir, for: $namespace . '\\Pages');
                }

                $widgetsDir = $moduleDir . DIRECTORY_SEPARATOR . 'Filament' . DIRECTORY_SEPARATOR . 'Admin' . DIRECTORY_SEPARATOR . 'Widgets';
                if (is_dir($widgetsDir)) {
                    $panel->discoverWidgets(in: $widgetsDir, for: $namespace . '\\Widgets');
                }
            }
        }

        return $panel;
    }
}

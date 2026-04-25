<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Analytics\Http\Actions\GetAnalyticsOverviewAction;
use Modules\Analytics\Http\Actions\GetDownloadStatsAction;
use Modules\Analytics\Http\Actions\GetRevenueStatsAction;

Route::middleware(['auth', 'role:admin'])->prefix('admin/analytics')->name('admin.analytics.')->group(static function (): void {
    Route::get('/', GetAnalyticsOverviewAction::class)->name('index');
    Route::get('revenue', GetRevenueStatsAction::class)->name('revenue');
    Route::get('downloads', GetDownloadStatsAction::class)->name('downloads');
});

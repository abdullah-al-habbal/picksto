<?php

// modules/Download/Routes/web.php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Download\Http\Actions\CheckEligibilityAction;
use Modules\Download\Http\Actions\GetDownloadHistoryAction;
use Modules\Download\Http\Actions\GetUserDownloadStatsAction;
use Modules\Download\Http\Actions\PreviewDownloadAction;
use Modules\Download\Http\Actions\RequestDownloadAction;
use Modules\Download\Http\Actions\ServeDownloadFileAction;

Route::middleware('auth')->prefix('download')->name('download.')->group(static function (): void {
    Route::post('preview', PreviewDownloadAction::class)->name('preview');
    Route::post('/', RequestDownloadAction::class)->name('request');
    Route::get('history', GetDownloadHistoryAction::class)->name('history');
    Route::get('stats', GetUserDownloadStatsAction::class)->name('stats');
    Route::get('check', CheckEligibilityAction::class)->name('check');
});

Route::middleware('auth')->get('downloads/{filename}', ServeDownloadFileAction::class)->name('downloads.serve');

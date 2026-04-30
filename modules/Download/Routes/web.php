<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Download\Http\Actions\ServeDownloadFileAction;

// File Serving (Protected, separate prefix for clean URLs)
Route::middleware('auth')->get('downloads/{filename}', ServeDownloadFileAction::class)->name('downloads.serve');

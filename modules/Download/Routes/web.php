<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Download\Http\Actions\ServeDownloadFileAction;

Route::middleware('auth')->get('downloads/{filename}', ServeDownloadFileAction::class)->name('downloads.serve');

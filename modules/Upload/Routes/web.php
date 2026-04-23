<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Upload\Http\Actions\DeleteFileAction;
use Modules\Upload\Http\Actions\UploadAvatarAction;
use Modules\Upload\Http\Actions\UploadFaviconAction;
use Modules\Upload\Http\Actions\UploadLogoAction;
use Modules\Upload\Http\Actions\UploadProductImageAction;

Route::middleware(['auth', 'role:admin'])->prefix('upload')->name('upload.')->group(static function (): void {
    Route::post('logo', UploadLogoAction::class)->name('logo');
    Route::post('favicon', UploadFaviconAction::class)->name('favicon');
    Route::post('product-image', UploadProductImageAction::class)->name('product-image');
    Route::delete('{folder}/{filename}', DeleteFileAction::class)->name('delete');
});

Route::middleware('auth')->post('upload/avatar', UploadAvatarAction::class)->name('avatar');

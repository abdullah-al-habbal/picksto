<?php

// modules/User/Routes/web.php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Actions\GetUserProfileAction;
use Modules\User\Http\Actions\UpdateUserProfileAction;
use Modules\User\Http\Actions\UploadUserAvatarAction;
use Modules\User\Http\Middleware\CheckUserBanMiddleware;

Route::middleware('auth')->prefix('user')->name('user.')->group(static function (): void {
    Route::middleware(CheckUserBanMiddleware::class)->group(static function (): void {
        Route::get('profile', GetUserProfileAction::class)->name('profile');
        Route::put('profile', UpdateUserProfileAction::class)->name('profile.update');
        Route::post('avatar', UploadUserAvatarAction::class)->name('avatar.upload');
    });
});

<?php

// modules/User/Routes/web.php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Actions\ActivateUserPackageAction;
use Modules\User\Http\Actions\ChangeUserRoleAction;
use Modules\User\Http\Actions\GetUserDetailsAction;
use Modules\User\Http\Actions\GetUserProfileAction;
use Modules\User\Http\Actions\ToggleUserBanAction;
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

Route::middleware(['auth', 'role:admin,supervisor'])->prefix('admin/users')->name('admin.users.')->group(static function (): void {
    Route::get('/', GetUserDetailsAction::class)->name('index');
    Route::get('{user}', GetUserDetailsAction::class)->name('show');

    Route::middleware('role:admin')->group(static function (): void {
        Route::put('{user}/role', ChangeUserRoleAction::class)->name('role.update');
        Route::post('{user}/package', ActivateUserPackageAction::class)->name('package.activate');
    });

    Route::put('{user}/ban', ToggleUserBanAction::class)->name('ban.toggle');
});

<?php

// modules/Auth/Routes/web.php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Actions\ForgotPasswordAction;
use Modules\Auth\Http\Actions\GetCurrentUserAction;
use Modules\Auth\Http\Actions\LoginAction;
use Modules\Auth\Http\Actions\RegisterAction;
use Modules\Auth\Http\Actions\ResetPasswordAction;

// Public auth routes
Route::prefix('auth')->name('auth.')->group(static function (): void {
    Route::post('register', RegisterAction::class)->name('register');
    Route::post('login', LoginAction::class)->name('login');
    Route::post('forgot-password', ForgotPasswordAction::class)->name('password.forgot');
    Route::post('reset-password', ResetPasswordAction::class)->name('password.reset');
});

// Protected auth routes
Route::middleware('auth')->prefix('auth')->name('auth.')->group(static function (): void {
    Route::get('me', GetCurrentUserAction::class)->name('me');
});

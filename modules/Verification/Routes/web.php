<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Verification\Http\Actions\GetAdminSettingsAction;
use Modules\Verification\Http\Actions\GetVerificationStatusAction;
use Modules\Verification\Http\Actions\ResendVerificationAction;
use Modules\Verification\Http\Actions\SendEmailVerificationAction;
use Modules\Verification\Http\Actions\SendWhatsAppVerificationAction;
use Modules\Verification\Http\Actions\TestEmailSettingsAction;
use Modules\Verification\Http\Actions\TestWhatsAppSettingsAction;
use Modules\Verification\Http\Actions\UpdateAdminSettingsAction;
use Modules\Verification\Http\Actions\VerifyCodeAction;

// Protected user routes
Route::middleware('auth')->prefix('verification')->name('verification.')->group(static function (): void {
    Route::post('send-email', SendEmailVerificationAction::class)->name('send-email');
    Route::post('send-whatsapp', SendWhatsAppVerificationAction::class)->name('send-whatsapp');
    Route::post('verify', VerifyCodeAction::class)->name('verify');
    Route::get('status', GetVerificationStatusAction::class)->name('status');
    Route::post('resend', ResendVerificationAction::class)->name('resend');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin/verification-settings')->name('admin.verification-settings.')->group(static function (): void {
    Route::get('/', GetAdminSettingsAction::class)->name('index');
    Route::put('/', UpdateAdminSettingsAction::class)->name('update');
    Route::post('test-email', TestEmailSettingsAction::class)->name('test-email');
    Route::post('test-whatsapp', TestWhatsAppSettingsAction::class)->name('test-whatsapp');
});

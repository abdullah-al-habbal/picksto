<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\TestProvider\Http\Actions\TestCustomBotAction;
use Modules\TestProvider\Http\Actions\TestProviderAction;

// Admin routes only - exact Node.js mapping
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(static function (): void {
    Route::post('test-provider', TestProviderAction::class)->name('test-provider');
    Route::post('test-custom-bot', TestCustomBotAction::class)->name('test-custom-bot');
});

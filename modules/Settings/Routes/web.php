<?php

// Settings/Routes/web.php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Settings\Http\Actions\GetSettingsAction;
use Modules\Settings\Http\Actions\UpdateSettingsAction;

// Public route (with optional auth for admin features)
Route::get('settings', GetSettingsAction::class)->name('settings');

// Admin route
Route::middleware(['auth', 'role:admin'])->post('settings', UpdateSettingsAction::class)->name('settings.update');

<?php

// Currency/Routes/web.php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Currency\Http\Actions\GetCurrencySettingsAction;
use Modules\Currency\Http\Actions\UpdateCurrencySettingsAction;

// Public route
Route::get('currency/settings', GetCurrencySettingsAction::class)->name('currency.settings');

// Admin route
Route::middleware(['auth', 'role:admin'])->put('currency/settings', UpdateCurrencySettingsAction::class)->name('currency.settings.update');

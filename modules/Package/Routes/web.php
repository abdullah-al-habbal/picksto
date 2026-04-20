<?php
// modules/Package/Routes/web.php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Package\Http\Actions\ListPackagesAction;
use Modules\Package\Http\Actions\CreatePackageAction;
use Modules\Package\Http\Actions\UpdatePackageAction;
use Modules\Package\Http\Actions\DeletePackageAction;

// Public: List all active packages
Route::get('packages', ListPackagesAction::class)->name('packages.index');

// Admin: Package management (requires admin role)
Route::middleware(['auth', 'role:admin'])->prefix('admin/packages')->name('admin.packages.')->group(static function (): void {
    Route::post('/', CreatePackageAction::class)->name('store');
    Route::put('{package}', UpdatePackageAction::class)->name('update');
    Route::delete('{package}', DeletePackageAction::class)->name('destroy');
});

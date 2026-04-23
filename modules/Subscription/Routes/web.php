<?php

// modules/Subscription/Routes/web.php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Subscription\Http\Actions\GetPendingCountAction;
use Modules\Subscription\Http\Actions\GetUserInvoicesAction;
use Modules\Subscription\Http\Actions\GetUserPendingAction;
use Modules\Subscription\Http\Actions\PurchasePackageAction;

Route::middleware('auth')->prefix('subscription')->name('subscription.')->group(static function (): void {
    Route::post('purchase', PurchasePackageAction::class)->name('purchase');
    Route::get('invoices', GetUserInvoicesAction::class)->name('invoices');
    Route::get('my-pending', GetUserPendingAction::class)->name('my-pending');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin/subscription')->name('admin.subscription.')->group(static function (): void {
    Route::get('pending-count', GetPendingCountAction::class)->name('pending-count');
});

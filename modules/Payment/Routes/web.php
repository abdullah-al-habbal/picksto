<?php

// Payment/Routes/web.php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Payment\Http\Actions\ApproveRequestAction;
use Modules\Payment\Http\Actions\CreateGatewayAction;
use Modules\Payment\Http\Actions\DeleteGatewayAction;
use Modules\Payment\Http\Actions\GetActiveGatewaysAction;
use Modules\Payment\Http\Actions\GetAllGatewaysAction;
use Modules\Payment\Http\Actions\GetAllRequestsAction;
use Modules\Payment\Http\Actions\RejectRequestAction;
use Modules\Payment\Http\Actions\RequestSubscriptionAction;
use Modules\Payment\Http\Actions\UpdateGatewayAction;

// Public routes
Route::get('payment/gateways', GetActiveGatewaysAction::class)->name('payment.gateways');

// Protected user routes
Route::middleware('auth')->prefix('payment')->name('payment.')->group(static function (): void {
    Route::post('request-subscription', RequestSubscriptionAction::class)->name('request-subscription');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin/payment')->name('admin.payment.')->group(static function (): void {
    Route::get('gateways', GetAllGatewaysAction::class)->name('gateways.index');
    Route::post('gateways', CreateGatewayAction::class)->name('gateways.store');
    Route::put('gateways/{gateway}', UpdateGatewayAction::class)->name('gateways.update');
    Route::delete('gateways/{gateway}', DeleteGatewayAction::class)->name('gateways.destroy');

    Route::get('requests', GetAllRequestsAction::class)->name('requests.index');
    Route::post('requests/{request}/approve', ApproveRequestAction::class)->name('requests.approve');
    Route::post('requests/{request}/reject', RejectRequestAction::class)->name('requests.reject');
});

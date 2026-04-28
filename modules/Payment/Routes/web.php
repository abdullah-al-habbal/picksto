<?php

// Payment/Routes/web.php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Payment\Http\Actions\GetActiveGatewaysAction;
use Modules\Payment\Http\Actions\RequestSubscriptionAction;

Route::get('payment/gateways', GetActiveGatewaysAction::class)->name('payment.gateways');

Route::middleware('auth')->prefix('payment')->name('payment.')->group(static function (): void {
    Route::post('request-subscription', RequestSubscriptionAction::class)->name('request-subscription');
});

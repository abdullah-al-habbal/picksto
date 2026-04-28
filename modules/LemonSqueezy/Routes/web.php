<?php

// modules/LemonSqueezy/Routes/web.php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\LemonSqueezy\Http\Actions\CreateCheckoutAction;
use Modules\LemonSqueezy\Http\Actions\GetProductsAction;
use Modules\LemonSqueezy\Http\Actions\HandleWebhookAction;

Route::post('lemonsqueezy/webhook', HandleWebhookAction::class)->name('lemonsqueezy.webhook');

Route::middleware('auth')->prefix('lemonsqueezy')->name('lemonsqueezy.')->group(static function (): void {
    Route::post('checkout', CreateCheckoutAction::class)->name('checkout');
    Route::get('products', GetProductsAction::class)->name('products');
});

<?php

// modules/LemonSqueezy/Routes/web.php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\LemonSqueezy\Http\Actions\CreateCheckoutAction;
use Modules\LemonSqueezy\Http\Actions\GetCustomerAction;
use Modules\LemonSqueezy\Http\Actions\GetCustomersAction;
use Modules\LemonSqueezy\Http\Actions\GetCustomerSubscriptionsAction;
use Modules\LemonSqueezy\Http\Actions\GetProductsAction;
use Modules\LemonSqueezy\Http\Actions\HandleWebhookAction;

// Public webhook route
Route::post('lemonsqueezy/webhook', HandleWebhookAction::class)->name('lemonsqueezy.webhook');

// Protected user routes
Route::middleware('auth')->prefix('lemonsqueezy')->name('lemonsqueezy.')->group(static function (): void {
    Route::post('checkout', CreateCheckoutAction::class)->name('checkout');
    Route::get('products', GetProductsAction::class)->name('products');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin/lemonsqueezy')->name('admin.lemonsqueezy.')->group(static function (): void {
    Route::get('customers', GetCustomersAction::class)->name('customers');
    Route::get('customers/{customerId}', GetCustomerAction::class)->name('customers.show');
    Route::get('customers/{customerId}/subscriptions', GetCustomerSubscriptionsAction::class)->name('customers.subscriptions');
});

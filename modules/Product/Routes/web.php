<?php

// Product/Routes/web.php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Actions\CreateProductAction;
use Modules\Product\Http\Actions\DeleteProductAction;
use Modules\Product\Http\Actions\ListProductsAction;
use Modules\Product\Http\Actions\UpdateProductAction;

// Public: List all active products
Route::get('products', ListProductsAction::class)->name('products.index');

// Admin: Product management
Route::middleware(['auth', 'role:admin'])->prefix('admin/products')->name('admin.products.')->group(static function (): void {
    Route::post('/', CreateProductAction::class)->name('store');
    Route::put('{product}', UpdateProductAction::class)->name('update');
    Route::delete('{product}', DeleteProductAction::class)->name('destroy');
});

<?php

// Product/Routes/web.php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Actions\ListProductsAction;

// Public: List all active products
Route::get('products', ListProductsAction::class)->name('products.index');

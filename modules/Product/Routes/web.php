<?php

// Product/Routes/web.php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Actions\ListProductsAction;
Route::get('products', ListProductsAction::class)->name('products.index');

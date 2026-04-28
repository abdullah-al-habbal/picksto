<?php

// modules/Package/Routes/web.php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Package\Http\Actions\ListPackagesAction;

Route::get('packages', ListPackagesAction::class)->name('packages.index');

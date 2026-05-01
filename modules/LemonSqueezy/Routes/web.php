<?php

// modules/LemonSqueezy/Routes/web.php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\LemonSqueezy\Http\Actions\HandleWebhookAction;

Route::post('lemonsqueezy/webhook', HandleWebhookAction::class)->name('lemonsqueezy.webhook');

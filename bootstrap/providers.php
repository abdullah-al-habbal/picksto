<?php
// bootstrap/providers.php

use App\Providers\ApplicationServiceProvider;
use App\Providers\ScrambleServiceProvider;
use Modules\Download\Providers\DownloadServiceProvider;
use Modules\Ticket\Providers\TicketServiceProvider;
use Modules\User\Providers\UserServiceProvider;
use Modules\Package\Providers\PackageServiceProvider;
use Modules\Subscription\Providers\SubscriptionServiceProvider;

return [
    ApplicationServiceProvider::class,
    ScrambleServiceProvider::class,
    UserServiceProvider::class,
    PackageServiceProvider::class,
    SubscriptionServiceProvider::class,
    DownloadServiceProvider::class,
    TicketServiceProvider::class,
];

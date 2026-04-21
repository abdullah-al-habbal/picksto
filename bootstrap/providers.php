<?php

// bootstrap/providers.php

use App\Providers\ApplicationServiceProvider;
use App\Providers\ScrambleServiceProvider;
use Modules\Currency\Providers\CurrencyServiceProvider;
use Modules\Package\Providers\PackageServiceProvider;
use Modules\Payment\Providers\PaymentServiceProvider;
use Modules\Product\Providers\ProductServiceProvider;
use Modules\Referral\Providers\ReferralServiceProvider;
use Modules\Subscription\Providers\SubscriptionServiceProvider;
use Modules\SubscriptionRequest\Providers\SubscriptionRequestServiceProvider;
use Modules\Ticket\Providers\TicketServiceProvider;
use Modules\User\Providers\UserServiceProvider;
use Modules\Verification\Providers\VerificationServiceProvider;

return [
    ApplicationServiceProvider::class,
    ScrambleServiceProvider::class,
    UserServiceProvider::class,
    PackageServiceProvider::class,
    SubscriptionServiceProvider::class,
    TicketServiceProvider::class,
    PaymentServiceProvider::class,
    SubscriptionRequestServiceProvider::class,
    ReferralServiceProvider::class,
    VerificationServiceProvider::class,
    ProductServiceProvider::class,
    CurrencyServiceProvider::class,
];

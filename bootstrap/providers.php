<?php
// picksto-laravel-service\bootstrap\providers.php
declare(strict_types=1);

use App\Providers\ApplicationServiceProvider;
use App\Providers\Filament\AdminPanelProvider;
use App\Providers\Filament\ClientPanelProvider;
use App\Providers\ScrambleServiceProvider;
use Modules\Analytics\Providers\AnalyticsServiceProvider;
use Modules\Currency\Providers\CurrencyServiceProvider;
use Modules\Download\Providers\DownloadServiceProvider;
use Modules\Language\Providers\LanguageServiceProvider;
use Modules\LemonSqueezy\Providers\LemonSqueezyServiceProvider;
use Modules\Package\Providers\PackageServiceProvider;
use Modules\Payment\Providers\PaymentServiceProvider;
use Modules\Product\Providers\ProductServiceProvider;
use Modules\Referral\Providers\ReferralServiceProvider;
use Modules\Settings\Providers\SettingsServiceProvider;
use Modules\SubscriptionRequest\Providers\SubscriptionRequestServiceProvider;
use Modules\Subscription\Providers\SubscriptionServiceProvider;
use Modules\TestProvider\Providers\TestProviderServiceProvider;
use Modules\Ticket\Providers\TicketServiceProvider;
use Modules\Upload\Providers\UploadServiceProvider;
use Modules\User\Providers\UserServiceProvider;
use Modules\Verification\Providers\VerificationServiceProvider;

return [
    ApplicationServiceProvider::class,
    AdminPanelProvider::class,
    ClientPanelProvider::class,
    ScrambleServiceProvider::class,
    AnalyticsServiceProvider::class,
    CurrencyServiceProvider::class,
    DownloadServiceProvider::class,
    LemonSqueezyServiceProvider::class,
    PackageServiceProvider::class,
    PaymentServiceProvider::class,
    ProductServiceProvider::class,
    ReferralServiceProvider::class,
    SettingsServiceProvider::class,
    SubscriptionRequestServiceProvider::class,
    SubscriptionServiceProvider::class,
    TestProviderServiceProvider::class,
    TicketServiceProvider::class,
    UploadServiceProvider::class,
    LanguageServiceProvider::class,
    UserServiceProvider::class,
    VerificationServiceProvider::class,
];

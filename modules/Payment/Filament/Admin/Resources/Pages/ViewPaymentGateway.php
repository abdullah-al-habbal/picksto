<?php

declare(strict_types=1);

namespace Modules\Payment\Filament\Admin\Resources\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\Payment\Filament\Admin\Resources\PaymentGatewayResource;

class ViewPaymentGateway extends ViewRecord
{
    protected static string $resource = PaymentGatewayResource::class;
}

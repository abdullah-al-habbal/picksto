<?php

declare(strict_types=1);

namespace Modules\Payment\Filament\Admin\Resources\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Payment\Filament\Admin\Resources\PaymentGatewayResource;

class CreatePaymentGateway extends CreateRecord
{
    protected static string $resource = PaymentGatewayResource::class;
}

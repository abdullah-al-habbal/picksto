<?php

// Payment/Repositories/PaymentGatewayRepository.php

declare(strict_types=1);

namespace Modules\Payment\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Payment\Models\PaymentGatewayModel;

final class PaymentGatewayRepository
{
    public function getActiveGateways(): Collection
    {
        return PaymentGatewayModel::active()->get();
    }

    public function getAllGateways(): Collection
    {
        return PaymentGatewayModel::all();
    }

    public function createGateway(array $data): PaymentGatewayModel
    {
        return PaymentGatewayModel::create($data);
    }

    public function updateGateway(int $id, array $data): ?PaymentGatewayModel
    {
        $gateway = PaymentGatewayModel::find($id);
        if ($gateway instanceof PaymentGatewayModel) {
            $gateway->update($data);
        }

        return $gateway;
    }

    public function deleteGateway(int $id): bool
    {
        return (bool) PaymentGatewayModel::destroy($id);
    }
}

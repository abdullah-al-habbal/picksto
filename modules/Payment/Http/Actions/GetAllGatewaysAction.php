<?php

// Payment/Http/Actions/GetAllGatewaysAction.php

declare(strict_types=1);

namespace Modules\Payment\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Payment\Presenters\PaymentPresenter;
use Modules\Payment\Repositories\PaymentRepository;

final class GetAllGatewaysAction
{
    public function __construct(
        private readonly PaymentRepository $paymentRepository,
        private readonly PaymentPresenter $paymentPresenter,
    ) {}

    public function __invoke(): JsonResponse
    {
        $gateways = $this->paymentRepository->getAllGateways();

        $presented = $gateways->map(fn ($g) => $this->paymentPresenter->presentGatewayAdmin($g));

        return response()->json([
            'success' => true,
            'gateways' => $presented,
        ]);
    }
}

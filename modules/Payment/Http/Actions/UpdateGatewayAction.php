<?php

// Payment/Http/Actions/UpdateGatewayAction.php

declare(strict_types=1);

namespace Modules\Payment\Http\Actions;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Modules\Payment\Http\Requests\UpdateGatewayRequest;
use Modules\Payment\Models\PaymentGatewayModel;
use Modules\Payment\Repositories\PaymentRepository;

final class UpdateGatewayAction
{
    public function __construct(
        private readonly PaymentRepository $paymentRepository,
    ) {}

    public function __invoke(UpdateGatewayRequest $request, PaymentGatewayModel $gateway): JsonResponse
    {
        DB::beginTransaction();

        try {
            $this->paymentRepository->updateGateway($gateway->id, $request->validated());

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => __('payment::messages.gateway_updated'),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => __('payment::errors.gateway_update_failed'),
            ], 500);
        }
    }
}

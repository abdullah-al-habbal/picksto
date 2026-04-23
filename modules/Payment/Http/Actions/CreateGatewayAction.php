<?php

// Payment/Http/Actions/CreateGatewayAction.php

declare(strict_types=1);

namespace Modules\Payment\Http\Actions;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Modules\Payment\Http\Requests\StoreGatewayRequest;
use Modules\Payment\Repositories\PaymentRepository;

final class CreateGatewayAction
{
    public function __construct(
        private readonly PaymentRepository $paymentRepository,
    ) {}

    public function __invoke(StoreGatewayRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            $gateway = $this->paymentRepository->createGateway($request->validated());

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => __('payment::messages.gateway_created'),
                'gateway' => [
                    'id' => $gateway->id,
                    'name' => $gateway->name,
                ],
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => __('payment::errors.gateway_create_failed'),
            ], 500);
        }
    }
}

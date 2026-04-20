<?php
// Payment/Http/Actions/DeleteGatewayAction.php

declare(strict_types=1);

namespace Modules\Payment\Http\Actions;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Modules\Payment\Models\PaymentGatewayModel;
use Modules\Payment\Repositories\PaymentRepository;

final class DeleteGatewayAction
{
    public function __construct(
        private readonly PaymentRepository $paymentRepository,
    ) {}

    public function __invoke(PaymentGatewayModel $gateway): JsonResponse
    {
        DB::beginTransaction();

        try {
            $this->paymentRepository->deleteGateway($gateway->id);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => __('payment::messages.gateway_deleted'),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => __('payment::errors.gateway_delete_failed'),
            ], 500);
        }
    }
}

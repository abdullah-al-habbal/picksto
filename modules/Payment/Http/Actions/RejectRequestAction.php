<?php
// Payment/Http/Actions/RejectRequestAction.php

declare(strict_types=1);

namespace Modules\Payment\Http\Actions;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Modules\Payment\Models\SubscriptionRequestModel;
use Modules\Payment\Repositories\PaymentRepository;

final class RejectRequestAction
{
    public function __construct(
        private readonly PaymentRepository $paymentRepository,
    ) {}

    public function __invoke(SubscriptionRequestModel $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            $this->paymentRepository->rejectRequest($request->id, auth()->id());

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => __('payment::messages.request_rejected'),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => __('payment::errors.request_reject_failed'),
            ], 500);
        }
    }
}

<?php

// Payment/Http/Actions/RequestSubscriptionAction.php

declare(strict_types=1);

namespace Modules\Payment\Http\Actions;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Modules\Payment\Http\Requests\RequestSubscriptionRequest;
use Modules\Payment\Repositories\PaymentRepository;

final class RequestSubscriptionAction
{
    public function __construct(
        private readonly PaymentRepository $paymentRepository,
    ) {}

    public function __invoke(RequestSubscriptionRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            $result = $this->paymentRepository->requestSubscription(
                $request->user()->id,
                $request->validated()
            );

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => __('payment::messages.request_submitted'),
                'request_id' => $result->id,
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => __('payment::errors.request_failed'),
            ], 500);
        }
    }
}

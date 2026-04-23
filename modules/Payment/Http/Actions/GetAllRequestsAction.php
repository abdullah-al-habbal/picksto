<?php

// Payment/Http/Actions/GetAllRequestsAction.php

declare(strict_types=1);

namespace Modules\Payment\Http\Actions;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Payment\Presenters\PaymentPresenter;
use Modules\Payment\Repositories\PaymentRepository;

final class GetAllRequestsAction
{
    public function __construct(
        private readonly PaymentRepository $paymentRepository,
        private readonly PaymentPresenter $paymentPresenter,
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        $status = $request->get('status');
        $requests = $this->paymentRepository->getAllRequests($status);

        $presented = $requests->map(fn ($r) => $this->paymentPresenter->presentRequest($r));

        return response()->json([
            'success' => true,
            'requests' => $presented,
        ]);
    }
}

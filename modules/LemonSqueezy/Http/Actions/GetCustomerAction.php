<?php

// modules/LemonSqueezy/Http/Actions/GetCustomerAction.php

declare(strict_types=1);

namespace Modules\LemonSqueezy\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\LemonSqueezy\Repositories\LemonSqueezyRepository;

final class GetCustomerAction
{
    public function __construct(
        private readonly LemonSqueezyRepository $repository,
    ) {}

    public function __invoke(int $customerId): JsonResponse
    {
        try {
            $customer = $this->repository->getCustomer($customerId);

            return response()->json([
                'success' => true,
                'customer' => $customer,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('lemonsqueezy::errors.fetch_failed'),
            ], 500);
        }
    }
}

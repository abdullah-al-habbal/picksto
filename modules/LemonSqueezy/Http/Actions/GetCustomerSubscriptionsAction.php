<?php

// modules/LemonSqueezy/Http/Actions/GetCustomerSubscriptionsAction.php

declare(strict_types=1);

namespace Modules\LemonSqueezy\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\LemonSqueezy\Repositories\LemonSqueezyRepository;

final class GetCustomerSubscriptionsAction
{
    public function __construct(
        private readonly LemonSqueezyRepository $repository,
    ) {}

    public function __invoke(int $customerId): JsonResponse
    {
        try {
            $subscriptions = $this->repository->getCustomerSubscriptions($customerId);

            return response()->json([
                'success' => true,
                'subscriptions' => $subscriptions,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('lemonsqueezy::errors.fetch_failed'),
            ], 500);
        }
    }
}

<?php

// modules/LemonSqueezy/Http/Actions/GetCustomersAction.php

declare(strict_types=1);

namespace Modules\LemonSqueezy\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\LemonSqueezy\Repositories\LemonSqueezyRepository;

final class GetCustomersAction
{
    public function __construct(
        private readonly LemonSqueezyRepository $repository,
    ) {}

    public function __invoke(): JsonResponse
    {
        try {
            $customers = $this->repository->getCustomers();

            return response()->json([
                'success' => true,
                'customers' => $customers,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('lemonsqueezy::errors.fetch_failed'),
            ], 500);
        }
    }
}

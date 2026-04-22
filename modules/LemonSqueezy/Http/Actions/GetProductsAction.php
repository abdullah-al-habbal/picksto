<?php

// modules/LemonSqueezy/Http/Actions/GetProductsAction.php

declare(strict_types=1);

namespace Modules\LemonSqueezy\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\LemonSqueezy\Repositories\LemonSqueezyRepository;

final class GetProductsAction
{
    public function __construct(
        private readonly LemonSqueezyRepository $repository,
    ) {}

    public function __invoke(): JsonResponse
    {
        try {
            $products = $this->repository->getProducts();

            return response()->json([
                'success' => true,
                'products' => $products,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('lemonsqueezy::errors.fetch_failed'),
            ], 500);
        }
    }
}

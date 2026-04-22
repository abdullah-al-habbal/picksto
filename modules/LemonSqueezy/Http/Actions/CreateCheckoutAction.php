<?php

// modules/LemonSqueezy/Http/Actions/CreateCheckoutAction.php

declare(strict_types=1);

namespace Modules\LemonSqueezy\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\LemonSqueezy\Http\Requests\CreateCheckoutRequest;
use Modules\LemonSqueezy\Repositories\LemonSqueezyRepository;

final class CreateCheckoutAction
{
    public function __construct(
        private readonly LemonSqueezyRepository $repository,
    ) {}

    public function __invoke(CreateCheckoutRequest $request): JsonResponse
    {
        try {
            $url = $this->repository->createCheckout(
                $request->user()->id,
                $request->validated('variantId'),
                $request->validated('customData') ?? []
            );

            return response()->json([
                'success' => true,
                'url' => $url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('lemonsqueezy::errors.checkout_failed'),
            ], 500);
        }
    }
}

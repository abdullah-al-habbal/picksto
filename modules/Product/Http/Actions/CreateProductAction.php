<?php

// Product/Http/Actions/CreateProductAction.php

declare(strict_types=1);

namespace Modules\Product\Http\Actions;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Modules\Product\Http\Requests\StoreProductRequest;
use Modules\Product\Repositories\ProductRepository;

final class CreateProductAction
{
    public function __construct(
        private readonly ProductRepository $productRepository,
    ) {}

    public function __invoke(StoreProductRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            $product = $this->productRepository->create($request->validated());

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => __('product::messages.created'),
                'product' => [
                    'id' => $product->id,
                    'name' => $product->name,
                ],
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => __('product::errors.create_failed'),
            ], 500);
        }
    }
}

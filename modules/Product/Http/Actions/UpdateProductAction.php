<?php

// Product/Http/Actions/UpdateProductAction.php

declare(strict_types=1);

namespace Modules\Product\Http\Actions;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Modules\Product\Http\Requests\UpdateProductRequest;
use Modules\Product\Models\ProductModel;
use Modules\Product\Repositories\ProductRepository;

final class UpdateProductAction
{
    public function __construct(
        private readonly ProductRepository $productRepository,
    ) {}

    public function __invoke(UpdateProductRequest $request, ProductModel $product): JsonResponse
    {
        DB::beginTransaction();

        try {
            $this->productRepository->update($product->id, $request->validated());

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => __('product::messages.updated'),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => __('product::errors.update_failed'),
            ], 500);
        }
    }
}

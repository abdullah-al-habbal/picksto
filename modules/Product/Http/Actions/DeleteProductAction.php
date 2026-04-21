<?php

// Product/Http/Actions/DeleteProductAction.php

declare(strict_types=1);

namespace Modules\Product\Http\Actions;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Modules\Product\Models\ProductModel;
use Modules\Product\Repositories\ProductRepository;

final class DeleteProductAction
{
    public function __construct(
        private readonly ProductRepository $productRepository,
    ) {}

    public function __invoke(ProductModel $product): JsonResponse
    {
        DB::beginTransaction();

        try {
            $this->productRepository->delete($product->id);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => __('product::messages.deleted'),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => __('product::errors.delete_failed'),
            ], 500);
        }
    }
}

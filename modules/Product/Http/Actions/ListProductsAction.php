<?php

// Product/Http/Actions/ListProductsAction.php

declare(strict_types=1);

namespace Modules\Product\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Product\Presenters\ProductPresenter;
use Modules\Product\Repositories\ProductRepository;

final class ListProductsAction
{
    public function __construct(
        private readonly ProductRepository $productRepository,
        private readonly ProductPresenter $productPresenter,
    ) {}

    public function __invoke(): JsonResponse
    {
        $products = $this->productRepository->getActiveProducts();

        $presented = $products->map(fn ($p) => $this->productPresenter->present($p));

        return response()->json([
            'success' => true,
            'products' => $presented,
        ]);
    }
}

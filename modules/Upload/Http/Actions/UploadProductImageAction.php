<?php

declare(strict_types=1);

namespace Modules\Upload\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Upload\Http\Requests\UploadImageRequest;
use Modules\Upload\Repositories\UploadRepository;

final class UploadProductImageAction
{
    public function __construct(
        private readonly UploadRepository $uploadRepository,
    ) {}

    public function __invoke(UploadImageRequest $request): JsonResponse
    {
        try {
            $result = $this->uploadRepository->storeProductImage($request->file('file'));

            return response()->json([
                'success' => true,
                'message' => __('upload::messages.product_uploaded'),
                'url' => $result['url'],
                'filename' => $result['filename'],
                'processing' => $result['processing'] ?? null,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}

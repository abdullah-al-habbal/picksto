<?php

declare(strict_types=1);

namespace Modules\Upload\Http\Actions;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Modules\Upload\Http\Requests\UploadImageRequest;
use Modules\Upload\Repositories\UploadRepository;

final class UploadLogoAction
{
    public function __construct(
        private readonly UploadRepository $uploadRepository,
    ) {}

    public function __invoke(UploadImageRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            $result = $this->uploadRepository->storeLogo($request->file('file'));

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => __('upload::messages.logo_uploaded'),
                'url' => $result['url'],
                'filename' => $result['filename'],
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}

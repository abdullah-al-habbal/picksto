<?php

declare(strict_types=1);

namespace Modules\Upload\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Upload\Http\Requests\DeleteFileRequest;
use Modules\Upload\Repositories\UploadRepository;

final class DeleteFileAction
{
    public function __construct(
        private readonly UploadRepository $uploadRepository,
    ) {}

    public function __invoke(DeleteFileRequest $request): JsonResponse
    {
        try {
            $this->uploadRepository->deleteFile(
                $request->validated('folder'),
                $request->validated('filename')
            );

            return response()->json([
                'success' => true,
                'message' => __('upload::messages.file_deleted'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}

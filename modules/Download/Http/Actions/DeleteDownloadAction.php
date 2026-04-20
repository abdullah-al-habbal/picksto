<?php
// modules/Download/Http/Actions/DeleteDownloadAction.php

declare(strict_types=1);

namespace Modules\Download\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Download\Models\DownloadModel;
use Modules\Download\Repositories\DownloadRepository;

final class DeleteDownloadAction
{
    public function __construct(
        private readonly DownloadRepository $downloadRepository,
    ) {}

    public function __invoke(DownloadModel $download): JsonResponse
    {
        $this->downloadRepository->delete($download->id);

        return response()->json([
            'success' => true,
            'message' => __('download::messages.deleted'),
        ]);
    }
}

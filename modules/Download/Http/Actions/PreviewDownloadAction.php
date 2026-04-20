<?php
// modules/Download/Http/Actions/PreviewDownloadAction.php

declare(strict_types=1);

namespace Modules\Download\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Download\Http\Requests\PreviewDownloadRequest;
use Modules\Download\Repositories\DownloadRepository;
use Modules\Download\Services\BrowserAutomationService;

final class PreviewDownloadAction
{
    public function __construct(
        private readonly DownloadRepository $downloadRepository,
        private readonly BrowserAutomationService $browserAutomationService,
    ) {}

    public function __invoke(PreviewDownloadRequest $request): JsonResponse
    {
        $url = $request->validated('url');
        $siteSource = $this->downloadRepository->detectSiteSource($url);

        $this->downloadRepository->checkUserEligibility($request->user()->id, $siteSource);

        $preview = $this->browserAutomationService->extractPreview($url, $siteSource);

        return response()->json([
            'success' => true,
            'preview' => [
                'url' => $url,
                'siteSource' => $siteSource,
                'title' => $preview['title'] ?? 'Unknown',
                'thumbnail' => $preview['thumbnail'] ?? null,
                'description' => $preview['description'] ?? '',
                'author' => $preview['author'] ?? '',
            ],
        ]);
    }
}

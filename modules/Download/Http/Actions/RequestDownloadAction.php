<?php

// modules/Download/Http/Actions/RequestDownloadAction.php

declare(strict_types=1);

namespace Modules\Download\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Download\Http\Requests\RequestDownloadRequest;
use Modules\Download\Jobs\ProcessDownloadJob;
use Modules\Download\Repositories\DownloadRepository;
use Modules\User\Models\UserModel;

final class RequestDownloadAction
{
    public function __construct(
        private readonly DownloadRepository $downloadRepository,
    ) {}

    public function __invoke(RequestDownloadRequest $request): JsonResponse
    {
        /** @var UserModel $user */
        $user = $request->user();
        $url = $request->validated('url');
        $siteSource = $this->downloadRepository->detectSiteSource($url);

        $this->downloadRepository->checkUserEligibility($user->id, $siteSource);

        $download = $this->downloadRepository->create([
            'user_id' => $user->id,
            'original_url' => $url,
            'site_source' => $siteSource,
            'ip_address' => $request->ip(),
        ]);

        ProcessDownloadJob::dispatch($download->id, $url, $siteSource, $user->id)
            ->onQueue('downloads');

        return response()->json([
            'success' => true,
            'download' => [
                'id' => $download->id,
                'status' => $download->status,
            ],
        ], 202);
    }
}

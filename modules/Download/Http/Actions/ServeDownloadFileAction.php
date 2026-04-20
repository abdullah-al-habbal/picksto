<?php
// modules/Download/Http/Actions/ServeDownloadFileAction.php

declare(strict_types=1);

namespace Modules\Download\Http\Actions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Modules\Download\Repositories\DownloadRepository;

final class ServeDownloadFileAction
{
    public function __construct(
        private readonly DownloadRepository $downloadRepository,
    ) {}

    public function __invoke(Request $request, string $filename)
    {
        $filename = basename($filename);

        if (str_contains($filename, '..') || str_starts_with($filename, '.')) {
            abort(403);
        }

        $download = $this->downloadRepository->findByFilenameAndUser($filename, $request->user()->id);

        if (! $download && ! $request->user()->isAdmin()) {
            abort(403);
        }

        $path = $download ? $download->download_path : 'downloads/' . $filename;

        if (! Storage::disk('local')->exists($path)) {
            abort(404);
        }

        return Storage::disk('local')->download($path);
    }
}

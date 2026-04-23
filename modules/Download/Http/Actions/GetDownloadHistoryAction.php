<?php

// modules/Download/Http/Actions/GetDownloadHistoryAction.php

declare(strict_types=1);

namespace Modules\Download\Http\Actions;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Download\Presenters\DownloadPresenter;
use Modules\Download\Repositories\DownloadRepository;

final class GetDownloadHistoryAction
{
    public function __construct(
        private readonly DownloadRepository $downloadRepository,
        private readonly DownloadPresenter $downloadPresenter,
    ) {}

    public function __invoke(Request $request): View
    {
        $downloads = $this->downloadRepository->getUserDownloads($request->user()->id);

        $presented = $downloads->map(fn ($d) => $this->downloadPresenter->presentList($d));

        return view('download::history.index', [
            'downloads' => $presented,
        ]);
    }
}

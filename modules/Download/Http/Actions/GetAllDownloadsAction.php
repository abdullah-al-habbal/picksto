<?php

// modules/Download/Http/Actions/GetAllDownloadsAction.php

declare(strict_types=1);

namespace Modules\Download\Http\Actions;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Download\Presenters\DownloadPresenter;
use Modules\Download\Repositories\DownloadRepository;

final class GetAllDownloadsAction
{
    public function __construct(
        private readonly DownloadRepository $downloadRepository,
        private readonly DownloadPresenter $downloadPresenter,
    ) {}

    public function __invoke(Request $request): View
    {
        $downloads = $this->downloadRepository->getAllWithRelations();

        $presented = $downloads->map(fn ($d) => $this->downloadPresenter->presentAdminList($d));

        return view('download::admin.index', [
            'downloads' => $presented,
        ]);
    }
}

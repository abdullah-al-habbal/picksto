<?php
// modules/Package/Http/Actions/ListPackagesAction.php

declare(strict_types=1);

namespace Modules\Package\Http\Actions;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Package\Presenters\PackagePresenter;
use Modules\Package\Repositories\PackageRepository;

final class ListPackagesAction
{
    public function __construct(
        private readonly PackageRepository $packageRepository,
        private readonly PackagePresenter $packagePresenter,
    ) {}

    public function __invoke(Request $request): View
    {
        $packages = $this->packageRepository->getActivePackages();

        $presentedPackages = $packages->map(fn ($package) =>
            $this->packagePresenter->present($package)
        );

        return view('package::packages.index', [
            'packages' => $presentedPackages,
        ]);
    }
}

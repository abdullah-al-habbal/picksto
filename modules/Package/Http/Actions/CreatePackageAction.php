<?php
// modules/Package/Http/Actions/CreatePackageAction.php

declare(strict_types=1);

namespace Modules\Package\Http\Actions;

use Illuminate\Support\Facades\DB;
use Modules\Package\Http\Requests\StorePackageRequest;
use Modules\Package\Repositories\PackageRepository;

final class CreatePackageAction
{
    public function __construct(
        private readonly PackageRepository $packageRepository,
    ) {}

    public function __invoke(StorePackageRequest $request)
    {
        DB::beginTransaction();

        try {
            $package = $this->packageRepository->create($request->validated());

            DB::commit();

            return redirect()->route('web.admin.packages.index')
                ->with('success', __('package::messages.created'));

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->with('error', __('package::errors.create_failed'));
        }
    }
}

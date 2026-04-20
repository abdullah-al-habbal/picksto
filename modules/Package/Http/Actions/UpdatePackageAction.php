<?php
// modules/Package/Http/Actions/UpdatePackageAction.php

declare(strict_types=1);

namespace Modules\Package\Http\Actions;

use Illuminate\Support\Facades\DB;
use Modules\Package\Http\Requests\UpdatePackageRequest;
use Modules\Package\Models\PackageModel;
use Modules\Package\Repositories\PackageRepository;

final class UpdatePackageAction
{
    public function __construct(
        private readonly PackageRepository $packageRepository,
    ) {}

    public function __invoke(UpdatePackageRequest $request, PackageModel $package)
    {
        DB::beginTransaction();

        try {
            $this->packageRepository->update($package->id, $request->validated());

            DB::commit();

            return redirect()->route('web.admin.packages.index')
                ->with('success', __('package::messages.updated'));

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->with('error', __('package::errors.update_failed'));
        }
    }
}

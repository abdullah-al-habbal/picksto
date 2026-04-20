<?php
// modules/Package/Http/Actions/DeletePackageAction.php

declare(strict_types=1);

namespace Modules\Package\Http\Actions;

use Illuminate\Support\Facades\DB;
use Modules\Package\Models\PackageModel;
use Modules\Package\Repositories\PackageRepository;

final class DeletePackageAction
{
    public function __construct(
        private readonly PackageRepository $packageRepository,
    ) {}

    public function __invoke(PackageModel $package)
    {
        DB::beginTransaction();

        try {
            $this->packageRepository->delete($package->id);

            DB::commit();

            return redirect()->route('web.admin.packages.index')
                ->with('success', __('package::messages.deleted'));

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->with('error', __('package::errors.delete_failed'));
        }
    }
}

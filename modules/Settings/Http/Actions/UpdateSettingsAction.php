<?php

// Settings/Http/Actions/UpdateSettingsAction.php

declare(strict_types=1);

namespace Modules\Settings\Http\Actions;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Modules\Settings\Http\Requests\UpdateSettingsRequest;
use Modules\Settings\Repositories\SettingsRepository;

final class UpdateSettingsAction
{
    public function __construct(
        private readonly SettingsRepository $settingsRepository,
    ) {}

    public function __invoke(UpdateSettingsRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            $this->settingsRepository->updateSettings($request->validated());

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => __('settings::messages.updated'),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => __('settings::errors.update_failed'),
            ], 500);
        }
    }
}

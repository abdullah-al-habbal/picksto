<?php

// Currency/Http/Actions/UpdateCurrencySettingsAction.php

declare(strict_types=1);

namespace Modules\Currency\Http\Actions;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Modules\Currency\Http\Requests\UpdateCurrencySettingsRequest;
use Modules\Currency\Repositories\CurrencyRepository;

final class UpdateCurrencySettingsAction
{
    public function __construct(
        private readonly CurrencyRepository $currencyRepository,
    ) {}

    public function __invoke(UpdateCurrencySettingsRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            $this->currencyRepository->updateSettings($request->validated());

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => __('currency::messages.updated'),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => __('currency::errors.update_failed'),
            ], 500);
        }
    }
}

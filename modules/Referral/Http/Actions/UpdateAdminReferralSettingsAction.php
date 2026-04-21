<?php

declare(strict_types=1);

namespace Modules\Referral\Http\Actions;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Modules\Referral\Http\Requests\UpdateReferralSettingsRequest;
use Modules\Referral\Repositories\ReferralRepository;

final class UpdateAdminReferralSettingsAction
{
    public function __construct(
        private readonly ReferralRepository $referralRepository,
    ) {}

    public function __invoke(UpdateReferralSettingsRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            $this->referralRepository->updateSettings($request->validated());

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => __('referral::messages.settings_updated'),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => __('referral::errors.settings_update_failed'),
            ], 500);
        }
    }
}

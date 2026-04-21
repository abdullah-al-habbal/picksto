<?php

declare(strict_types=1);

namespace Modules\Referral\Http\Actions;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Modules\Referral\Http\Requests\ClaimRewardRequest;
use Modules\Referral\Repositories\ReferralRepository;

final class ClaimRewardAction
{
    public function __construct(
        private readonly ReferralRepository $referralRepository,
    ) {}

    public function __invoke(ClaimRewardRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            $result = $this->referralRepository->claimReward(
                $request->user()->id,
                $request->validated('rewardId')
            );

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => __('referral::messages.reward_claimed'),
                'reward' => $result,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => __('referral::errors.claim_failed'),
            ], 500);
        }
    }
}

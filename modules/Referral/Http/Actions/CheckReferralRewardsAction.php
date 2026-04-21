<?php

declare(strict_types=1);

namespace Modules\Referral\Http\Actions;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Referral\Repositories\ReferralRepository;

final class CheckReferralRewardsAction
{
    public function __construct(
        private readonly ReferralRepository $referralRepository,
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        $result = $this->referralRepository->checkAndCreateRewards($request->user()->id);

        return response()->json([
            'success' => true,
            ...$result,
        ]);
    }
}

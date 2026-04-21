<?php

declare(strict_types=1);

namespace Modules\Referral\Http\Actions;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Referral\Repositories\ReferralRepository;

final class GetReferralStatsAction
{
    public function __construct(
        private readonly ReferralRepository $referralRepository,
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        $stats = $this->referralRepository->getUserStats($request->user()->id);

        return response()->json([
            'success' => true,
            'stats' => $stats,
        ]);
    }
}

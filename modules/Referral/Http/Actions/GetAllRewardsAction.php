<?php

declare(strict_types=1);

namespace Modules\Referral\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Referral\Presenters\ReferralPresenter;
use Modules\Referral\Repositories\ReferralRepository;

final class GetAllRewardsAction
{
    public function __construct(
        private readonly ReferralRepository $referralRepository,
        private readonly ReferralPresenter $referralPresenter,
    ) {}

    public function __invoke(): JsonResponse
    {
        $rewards = $this->referralRepository->getAllRewards();

        $presented = $rewards->map(fn ($r) => $this->referralPresenter->presentReward($r));

        return response()->json([
            'success' => true,
            'rewards' => $presented,
        ]);
    }
}

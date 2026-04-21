<?php

declare(strict_types=1);

namespace Modules\Referral\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Referral\Presenters\ReferralPresenter;
use Modules\Referral\Repositories\ReferralRepository;

final class GetAllReferralsAction
{
    public function __construct(
        private readonly ReferralRepository $referralRepository,
        private readonly ReferralPresenter $referralPresenter,
    ) {}

    public function __invoke(): JsonResponse
    {
        $referrals = $this->referralRepository->getAllReferrals();

        $presented = $referrals->map(fn ($r) => $this->referralPresenter->presentReferral($r));

        return response()->json([
            'success' => true,
            'referrals' => $presented,
        ]);
    }
}

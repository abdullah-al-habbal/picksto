<?php

declare(strict_types=1);

namespace Modules\Referral\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Referral\Repositories\ReferralRepository;

final class GetAdminReferralSettingsAction
{
    public function __construct(
        private readonly ReferralRepository $referralRepository,
    ) {}

    public function __invoke(): JsonResponse
    {
        $settings = $this->referralRepository->getSettings();

        return response()->json([
            'success' => true,
            'settings' => $settings,
        ]);
    }
}

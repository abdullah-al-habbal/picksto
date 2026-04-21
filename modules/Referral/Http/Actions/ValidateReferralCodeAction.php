<?php

declare(strict_types=1);

namespace Modules\Referral\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Referral\Repositories\ReferralRepository;

final class ValidateReferralCodeAction
{
    public function __construct(
        private readonly ReferralRepository $referralRepository,
    ) {}

    public function __invoke(string $code): JsonResponse
    {
        $result = $this->referralRepository->validateCode($code);

        return response()->json([
            'success' => $result['valid'],
            ...$result,
        ]);
    }
}

<?php

declare(strict_types=1);

namespace Modules\Verification\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Verification\Repositories\VerificationRepository;

final class GetAdminSettingsAction
{
    public function __construct(
        private readonly VerificationRepository $verificationRepository,
    ) {}

    public function __invoke(): JsonResponse
    {
        $settings = $this->verificationRepository->getAdminSettings();

        return response()->json([
            'success' => true,
            'settings' => $settings,
        ]);
    }
}

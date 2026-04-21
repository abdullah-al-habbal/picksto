<?php

declare(strict_types=1);

namespace Modules\Verification\Http\Actions;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Verification\Repositories\VerificationRepository;

final class TestEmailSettingsAction
{
    public function __construct(
        private readonly VerificationRepository $verificationRepository,
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        $testEmail = $request->input('testEmail');

        if (! $testEmail) {
            return response()->json([
                'success' => false,
                'message' => __('verification::errors.test_email_required'),
            ], 400);
        }

        $result = $this->verificationRepository->testEmailSettings($testEmail);

        return response()->json($result);
    }
}

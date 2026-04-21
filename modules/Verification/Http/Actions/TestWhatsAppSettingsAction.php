<?php

declare(strict_types=1);

namespace Modules\Verification\Http\Actions;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Verification\Repositories\VerificationRepository;

final class TestWhatsAppSettingsAction
{
    public function __construct(
        private readonly VerificationRepository $verificationRepository,
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        $testPhone = $request->input('testPhone');

        if (! $testPhone) {
            return response()->json([
                'success' => false,
                'message' => __('verification::errors.test_phone_required'),
            ], 400);
        }

        $result = $this->verificationRepository->testWhatsAppSettings($testPhone);

        return response()->json($result);
    }
}

<?php

declare(strict_types=1);

namespace Modules\Verification\Http\Actions;

use Illuminate\Http\JsonResponse;
use Modules\Verification\Http\Requests\VerifyCodeRequest;
use Modules\Verification\Repositories\VerificationRepository;

final class VerifyCodeAction
{
    public function __construct(
        private readonly VerificationRepository $verificationRepository,
    ) {}

    public function __invoke(VerifyCodeRequest $request): JsonResponse
    {
        $result = $this->verificationRepository->verifyCode(
            $request->user()->id,
            $request->validated('code'),
            $request->validated('type')
        );

        return response()->json($result);
    }
}

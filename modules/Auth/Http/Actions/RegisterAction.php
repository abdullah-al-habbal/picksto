<?php
// modules/Auth/Http/Actions/RegisterAction.php

declare(strict_types=1);

namespace Modules\Auth\Http\Actions;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Http\Requests\RegisterRequest;
use Modules\Auth\Repositories\AuthRepository;
use Modules\Referral\Services\ReferralService;

final class RegisterAction
{
    public function __construct(
        private readonly AuthRepository $authRepository,
        private readonly ReferralService $referralService,
    ) {}

    public function __invoke(RegisterRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $user = $this->authRepository->register($request->validated());

            event(new Registered($user));

            // Process referral if code provided
            if ($request->filled('referredBy')) {
                $this->referralService->processNewReferral(
                    $user->id,
                    $request->string('referredBy')
                );
            }

            DB::commit();

            auth()->login($user);

            return redirect()->route('web.dashboard')
                ->with('success', __('auth::messages.registered'));

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->with('error', __('auth::errors.registration_failed'));
        }
    }
}

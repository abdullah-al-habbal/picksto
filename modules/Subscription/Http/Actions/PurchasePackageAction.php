<?php
// modules/Subscription/Http/Actions/PurchasePackageAction.php

declare(strict_types=1);

namespace Modules\Subscription\Http\Actions;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Modules\Subscription\Http\Requests\PurchasePackageRequest;
use Modules\Subscription\Repositories\SubscriptionRepository;

final class PurchasePackageAction
{
    public function __construct(
        private readonly SubscriptionRepository $subscriptionRepository,
    ) {}

    public function __invoke(PurchasePackageRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $result = $this->subscriptionRepository->purchasePackage(
                $request->user()->id,
                $request->validated('packageId')
            );

            DB::commit();

            if ($result['status'] === 'pending') {
                return redirect()->route('web.subscription.my-pending')
                    ->with('success', __('subscription::messages.purchase_pending'));
            }

            return redirect()->route('web.dashboard')
                ->with('success', __('subscription::messages.purchase_success'));

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->with('error', __('subscription::errors.purchase_failed'));
        }
    }
}

<?php
// modules/Subscription/Http/Actions/GetUserPendingAction.php

declare(strict_types=1);

namespace Modules\Subscription\Http\Actions;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Subscription\Presenters\SubscriptionPresenter;
use Modules\Subscription\Repositories\SubscriptionRepository;

final class GetUserPendingAction
{
    public function __construct(
        private readonly SubscriptionRepository $subscriptionRepository,
        private readonly SubscriptionPresenter $subscriptionPresenter,
    ) {}

    public function __invoke(Request $request): View
    {
        $pending = $this->subscriptionRepository->getUserPending($request->user()->id);

        $presentedPending = $pending->map(fn ($sub) =>
            $this->subscriptionPresenter->present($sub)
        );

        return view('subscription::pending.index', [
            'pending' => $presentedPending,
        ]);
    }
}

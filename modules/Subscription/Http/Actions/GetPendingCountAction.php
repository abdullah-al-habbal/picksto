<?php

// modules/Subscription/Http/Actions/GetPendingCountAction.php

declare(strict_types=1);

namespace Modules\Subscription\Http\Actions;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Subscription\Repositories\SubscriptionRepository;

final class GetPendingCountAction
{
    public function __construct(
        private readonly SubscriptionRepository $subscriptionRepository,
    ) {}

    public function __invoke(Request $request): View
    {
        $count = $this->subscriptionRepository->getPendingCount();

        return view('subscription::admin.pending-count', [
            'pendingCount' => $count,
        ]);
    }
}

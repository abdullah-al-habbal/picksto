<?php

// modules/Subscription/Http/Actions/GetUserInvoicesAction.php

declare(strict_types=1);

namespace Modules\Subscription\Http\Actions;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Subscription\Presenters\SubscriptionPresenter;
use Modules\Subscription\Repositories\SubscriptionRepository;

final class GetUserInvoicesAction
{
    public function __construct(
        private readonly SubscriptionRepository $subscriptionRepository,
        private readonly SubscriptionPresenter $subscriptionPresenter,
    ) {}

    public function __invoke(Request $request): View
    {
        $invoices = $this->subscriptionRepository->getUserInvoices($request->user()->id);

        $presentedInvoices = $invoices->map(fn ($invoice) => $this->subscriptionPresenter->presentInvoice($invoice)
        );

        return view('subscription::invoices.index', [
            'invoices' => $presentedInvoices,
        ]);
    }
}

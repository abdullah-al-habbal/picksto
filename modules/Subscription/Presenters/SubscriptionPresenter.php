<?php

// modules/Subscription/Presenters/SubscriptionPresenter.php

declare(strict_types=1);

namespace Modules\Subscription\Presenters;

use Modules\Subscription\Models\SubscriptionModel;

final class SubscriptionPresenter
{
    public function present(SubscriptionModel $subscription): array
    {
        return [
            'id' => $subscription->id,
            'packageName' => $subscription->package->name,
            'packageNameAr' => $subscription->package->name_ar,
            'status' => $subscription->status,
            'statusLabel' => $this->getStatusLabel($subscription->status),
            'startDate' => $subscription->start_date?->format('Y-m-d'),
            'endDate' => $subscription->end_date?->format('Y-m-d'),
            'downloadsToday' => $subscription->downloads_today,
            'downloadsMonth' => $subscription->downloads_month,
            'dailyLimit' => $subscription->package->daily_limit,
            'monthlyLimit' => $subscription->package->monthly_limit,
            'remainingToday' => $subscription->remaining_downloads_today,
            'remainingMonth' => $subscription->remaining_downloads_month,
            'lastDownloadDate' => $subscription->last_download_date?->format('Y-m-d H:i'),
            'paymentMethod' => $subscription->payment_method,
            'transactionId' => $subscription->transaction_id,
            'isActive' => $subscription->isActive(),
            'canDownload' => $subscription->canDownload(),
            'createdAt' => $subscription->created_at?->format('Y-m-d'),
        ];
    }

    public function presentInvoice(SubscriptionModel $subscription): array
    {
        return [
            'id' => $subscription->id,
            'packageName' => $subscription->package->name,
            'price' => (float) $subscription->package->price,
            'currency' => $subscription->package->currency,
            'status' => $subscription->status,
            'startDate' => $subscription->start_date?->format('Y-m-d'),
            'endDate' => $subscription->end_date?->format('Y-m-d'),
            'paymentMethod' => $subscription->payment_method,
            'transactionId' => $subscription->transaction_id,
            'createdAt' => $subscription->created_at?->format('Y-m-d H:i'),
        ];
    }

    private function getStatusLabel(string $status): string
    {
        return match ($status) {
            'active' => __('subscription::labels.status_active'),
            'pending' => __('subscription::labels.status_pending'),
            'expired' => __('subscription::labels.status_expired'),
            'cancelled' => __('subscription::labels.status_cancelled'),
            default => $status,
        };
    }
}

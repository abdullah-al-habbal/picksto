<?php

// Payment/Presenters/PaymentPresenter.php

declare(strict_types=1);

namespace Modules\Payment\Presenters;

use Modules\Payment\Models\PaymentGatewayModel;
use Modules\SubscriptionRequest\Models\SubscriptionRequestModel;

final class PaymentPresenter
{
    public function presentGateway(PaymentGatewayModel $gateway): array
    {
        return [
            'id' => $gateway->id,
            'name' => $gateway->name,
            'type' => $gateway->type,
            'description' => $gateway->description,
            'isActive' => $gateway->is_active,
            'sortOrder' => $gateway->sort_order,
        ];
    }

    public function presentGatewayAdmin(PaymentGatewayModel $gateway): array
    {
        return [
            'id' => $gateway->id,
            'name' => $gateway->name,
            'type' => $gateway->type,
            'description' => $gateway->description,
            'config' => $gateway->config,
            'isActive' => $gateway->is_active,
            'sortOrder' => $gateway->sort_order,
            'createdAt' => $gateway->created_at?->format('Y-m-d H:i'),
        ];
    }

    public function presentRequest(SubscriptionRequestModel $request): array
    {
        return [
            'id' => $request->id,
            'user' => [
                'id' => $request->user?->id,
                'name' => $request->user?->name,
                'email' => $request->user?->email,
            ],
            'package' => [
                'id' => $request->package?->id,
                'name' => $request->package?->name,
                'price' => (float) $request->package?->price,
            ],
            'gateway' => $request->gateway ? [
                'id' => $request->gateway->id,
                'name' => $request->gateway->name,
            ] : null,
            'status' => $request->status,
            'amount' => (float) $request->amount,
            'currency' => $request->currency,
            'transactionId' => $request->transaction_id,
            'userNotes' => $request->user_notes,
            'adminNotes' => $request->admin_notes,
            'approvedAt' => $request->approved_at?->format('Y-m-d H:i'),
            'approver' => $request->approver?->name,
            'createdAt' => $request->created_at?->format('Y-m-d H:i'),
        ];
    }
}

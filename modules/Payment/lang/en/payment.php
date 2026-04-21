<?php

// Payment/lang/en/payment.php

declare(strict_types=1);

return [
    'validation' => [
        'packageId' => [
            'required' => 'Please select a package',
            'exists' => 'Selected package does not exist',
        ],
        'gatewayId' => [
            'exists' => 'Selected payment gateway does not exist',
        ],
        'gateway' => [
            'name' => ['required' => 'Gateway name is required'],
            'type' => [
                'required' => 'Gateway type is required',
                'in' => 'Gateway type not supported',
            ],
        ],
    ],
    'messages' => [
        'request_submitted' => 'Your request has been submitted and will be reviewed soon',
        'gateway_created' => 'Payment gateway added successfully',
        'gateway_updated' => 'Payment gateway updated successfully',
        'gateway_deleted' => 'Payment gateway deleted successfully',
        'request_approved' => 'Subscription activated successfully',
        'request_rejected' => 'Request has been rejected',
    ],
    'errors' => [
        'request_failed' => 'Failed to submit request, please try again',
        'gateway_create_failed' => 'Failed to add payment gateway',
        'gateway_update_failed' => 'Failed to update payment gateway',
        'gateway_delete_failed' => 'Failed to delete payment gateway',
        'request_approve_failed' => 'Failed to activate subscription',
        'request_reject_failed' => 'Failed to reject request',
    ],
    'labels' => [
        'gateway' => 'Payment Gateway',
        'type' => 'Type',
        'status' => 'Status',
        'amount' => 'Amount',
        'transaction_id' => 'Transaction ID',
        'user_notes' => 'User Notes',
        'admin_notes' => 'Admin Notes',
        'pending_requests' => 'Pending Requests',
        'payment_gateways' => 'Payment Gateways',
        'request_subscription' => 'Request Subscription',
    ],
    'types' => [
        'stripe' => 'Stripe',
        'paypal' => 'PayPal',
        'manual' => 'Manual Payment',
        'lemonsqueezy' => 'Lemon Squeezy',
    ],
    'statuses' => [
        'pending' => '🟡 Pending',
        'approved' => '🟢 Approved',
        'rejected' => '🔴 Rejected',
        'completed' => '✅ Completed',
    ],
];

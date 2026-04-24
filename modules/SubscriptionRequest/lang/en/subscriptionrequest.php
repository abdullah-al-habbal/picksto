<?php

declare(strict_types=1);

return [
    'actions' => [
        'approve' => 'Approve',
        'reject' => 'Reject',
    ],
    'fields' => [
        'user' => 'User',
        'package' => 'Package',
        'gateway' => 'Gateway',
        'amount' => 'Amount',
        'status' => 'Status',
        'transaction_id' => 'Transaction ID',
        'user_notes' => 'User Notes',
        'admin_notes' => 'Admin Notes',
        'approved_by' => 'Approved By',
        'approved_at' => 'Approved At',
    ],
    'statuses' => [
        'pending' => 'Pending',
        'approved' => 'Approved',
        'rejected' => 'Rejected',
        'completed' => 'Completed',
    ],
    'messages' => [
        'request_approved' => 'Subscription request approved.',
        'request_rejected' => 'Subscription request rejected.',
    ],
    'labels' => [
        'requests' => 'Subscription Requests',
        'no_requests' => 'No subscription requests found',
    ],
];

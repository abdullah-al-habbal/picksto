<?php
// Ticket/lang/en/ticket.php

declare(strict_types=1);

return [
    'validation' => [
        'subject' => ['required' => 'Subject is required'],
        'message' => ['required' => 'Message is required'],
        'reply' => ['required' => 'Reply message is required'],
    ],
    'messages' => [
        'created' => 'Ticket created successfully',
        'reply_added' => 'Reply added successfully',
        'status_updated' => 'Ticket status updated',
        'deleted' => 'Ticket deleted successfully',
    ],
    'errors' => [
        'create_failed' => 'Failed to create ticket',
        'reply_failed' => 'Failed to add reply',
        'status_update_failed' => 'Failed to update status',
        'delete_failed' => 'Failed to delete ticket',
    ],
    'labels' => [
        'status_open' => 'Open',
        'status_pending' => 'Pending',
        'status_closed' => 'Closed',
        'status_resolved' => 'Resolved',
        'priority_low' => 'Low',
        'priority_medium' => 'Medium',
        'priority_high' => 'High',
    ],
];
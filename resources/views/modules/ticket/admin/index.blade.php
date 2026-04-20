@extends('layouts.admin')
@section('title', 'Ticket Management')
@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="mb-0">All Tickets</h5>
                <form method="GET" class="d-flex gap-2">
                    <select name="status" class="form-select form-select-sm">
                        <option value="">All Status</option>
                        <option value="open" {{ request('status') === 'open' ? 'selected' : '' }}>Open</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                    <button class="btn btn-sm btn-primary">Filter</button>
                </form>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Priority</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tickets as $t)
                            <tr>
                                <td>{{ $t['user'] }}<br><small>{{ $t['userEmail'] }}</small></td>
                                <td>{{ $t['subject'] }}</td>
                                <td><span
                                        class="badge bg-{{ $t['status'] === 'open' ? 'success' : ($t['status'] === 'pending' ? 'warning' : 'secondary') }}">{{ $t['status'] }}</span>
                                </td>
                                <td>{{ __('ticket::labels.priority_' . $t['priority']) }}</td>
                                <td>{{ $t['createdAt'] }}</td>
                                <td>
                                    <form action="{{ route('web.admin.tickets.status.update', $t['id']) }}" method="POST"
                                        class="d-inline">
                                        @csrf @method('PUT')
                                        <button class="btn btn-sm btn-outline-primary">Change Status</button>
                                    </form>
                                    <form action="{{ route('web.admin.tickets.destroy', $t['id']) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Delete?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No tickets found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
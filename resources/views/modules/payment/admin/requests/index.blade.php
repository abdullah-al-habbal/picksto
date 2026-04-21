@extends('layouts.admin')

@section('title', 'Subscription Requests')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Subscription Requests</h5>
            <div class="d-flex gap-2">
                <select id="statusFilter" class="form-select form-select-sm" style="width: auto;">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                    <option value="completed">Completed</option>
                </select>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Package</th>
                        <th>Gateway</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($requests as $request)
                    <tr>
                        <td>
                            {{ $request['user']['name'] }}<br>
                            <small class="text-muted">{{ $request['user']['email'] }}</small>
                        </td>
                        <td>{{ $request['package']['name'] }}</td>
                        <td>{{ $request['gateway']['name'] ?? 'Manual' }}</td>
                        <td>{{ number_format($request['amount'], 2) }} {{ $request['currency'] }}</td>
                        <td>
                            <span class="badge bg-{{
                                $request['status'] === 'pending' ? 'warning' :
                                ($request['status'] === 'approved' ? 'success' :
                                ($request['status'] === 'rejected' ? 'danger' : 'secondary'))
                            }}">
                                {{ __('payment::statuses.' . $request['status']) }}
                            </span>
                        </td>
                        <td>{{ $request['createdAt'] }}</td>
                        <td>
                            @if($request['status'] === 'pending')
                                <form method="POST" action="{{ route('web.admin.payment.requests.approve', $request['id']) }}" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-success">Approve</button>
                                </form>
                                <form method="POST" action="{{ route('web.admin.payment.requests.reject', $request['id']) }}" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-danger">Reject</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center">No requests found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

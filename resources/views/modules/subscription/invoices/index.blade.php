@extends('layouts.app')

@section('title', __('subscription::labels.invoices'))

@section('content')
<div class="container py-4">
    <h2 class="mb-4">{{ __('subscription::labels.invoices') }}</h2>

    @if($invoices->isEmpty())
        <div class="alert alert-info">
            {{ __('subscription::messages.no_invoices') }}
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>{{ __('subscription::labels.package') }}</th>
                        <th>{{ __('subscription::labels.status') }}</th>
                        <th>{{ __('subscription::labels.start_date') }}</th>
                        <th>{{ __('subscription::labels.end_date') }}</th>
                        <th>{{ __('subscription::labels.payment_method') }}</th>
                        <th>{{ __('subscription::labels.transaction_id') }}</th>
                        <th>{{ __('subscription::labels.created_at') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice['packageName'] }}</td>
                        <td>
                            <span class="badge bg-{{ $invoice['status'] === 'active' ? 'success' : ($invoice['status'] === 'pending' ? 'warning' : 'secondary') }}">
                                {{ $invoice['statusLabel'] }}
                            </span>
                        </td>
                        <td>{{ $invoice['startDate'] }}</td>
                        <td>{{ $invoice['endDate'] }}</td>
                        <td>{{ $invoice['paymentMethod'] ?? '-' }}</td>
                        <td><small class="text-muted">{{ $invoice['transactionId'] ?? '-' }}</small></td>
                        <td>{{ $invoice['createdAt'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection

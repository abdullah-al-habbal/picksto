@extends('layouts.app')

@section('title', __('subscription::labels.pending_subscriptions'))

@section('content')
<div class="container py-4">
    <h2 class="mb-4">{{ __('subscription::labels.pending_subscriptions') }}</h2>

    @if($pending->isEmpty())
        <div class="alert alert-success">
            {{ __('subscription::messages.no_pending') }}
        </div>
    @else
        @foreach($pending as $sub)
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">{{ $sub['packageName'] }}</h5>
                        <p class="card-text text-muted">
                            {{ __('subscription::labels.start_date') }}: {{ $sub['startDate'] }}
                        </p>
                    </div>
                    <span class="badge bg-warning text-dark">
                        {{ __('subscription::labels.status_pending') }}
                    </span>
                </div>
                <p class="mb-0 small text-muted">
                    {{ __('subscription::messages.pending_info') }}
                </p>
            </div>
        </div>
        @endforeach
    @endif
</div>
@endsection

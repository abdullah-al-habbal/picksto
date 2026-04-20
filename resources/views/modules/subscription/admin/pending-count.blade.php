@extends('layouts.admin')

@section('title', 'Pending Subscriptions')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <h1 class="display-4 text-primary">{{ $pendingCount }}</h1>
                    <p class="text-muted">Pending Subscription Requests</p>
                    <a href="{{ route('web.admin.payments.requests') }}" class="btn btn-primary">
                        Review Requests
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

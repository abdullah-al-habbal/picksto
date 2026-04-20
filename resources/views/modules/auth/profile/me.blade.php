@extends('layouts.app')

@section('title', __('auth::labels.my_account'))

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">{{ __('auth::labels.my_account') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img src="{{ $user['avatar'] ?? asset('images/default-avatar.png') }}"
                                 class="rounded-circle mb-3"
                                 width="100"
                                 height="100"
                                 alt="{{ $user['name'] }}">
                            <h6>{{ $user['name'] }}</h6>
                            <span class="badge bg-{{ $user['role'] === 'admin' ? 'danger' : ($user['role'] === 'supervisor' ? 'warning' : 'secondary') }}">
                                {{ ucfirst($user['role']) }}
                            </span>
                        </div>
                        <div class="col-md-8">
                            <dl class="row">
                                <dt class="col-sm-4">{{ __('auth::labels.email') }}</dt>
                                <dd class="col-sm-8">{{ $user['email'] }}</dd>

                                <dt class="col-sm-4">{{ __('auth::labels.phone') }}</dt>
                                <dd class="col-sm-8">{{ $user['phone'] ?? '-' }}</dd>

                                <dt class="col-sm-4">{{ __('auth::labels.profession') }}</dt>
                                <dd class="col-sm-8">{{ $user['profession'] ?? '-' }}</dd>

                                <dt class="col-sm-4">{{ __('auth::labels.companySize') }}</dt>
                                <dd class="col-sm-8">{{ $user['companySize'] ?? '-' }}</dd>

                                <dt class="col-sm-4">{{ __('user::labels.status') }}</dt>
                                <dd class="col-sm-8">
                                    @if($user['isBanned'])
                                        <span class="badge bg-danger">Banned</span>
                                    @else
                                        <span class="badge bg-success">Active</span>
                                    @endif
                                </dd>

                                <dt class="col-sm-4">Subscription</dt>
                                <dd class="col-sm-8">
                                    @if($user['hasActiveSubscription'])
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">No subscription</span>
                                    @endif
                                </dd>
                            </dl>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('web.user.profile') }}" class="btn btn-primary">
                            {{ __('user::labels.edit_profile') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

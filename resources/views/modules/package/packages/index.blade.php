@extends('layouts.app')

@section('title', __('package::labels.packages'))

@section('content')
<div class="container py-4">
    <h2 class="mb-4">{{ __('package::labels.packages') }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
        @forelse($packages as $package)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $package['name'] }}</h5>
                    <p class="card-text text-muted">{{ $package['description'] }}</p>

                    <div class="mb-3">
                        <span class="badge bg-primary">
                            {{ number_format($package['price'], 2) }} {{ $package['currency'] }}
                        </span>
                        <span class="badge bg-secondary ms-1">
                            {{ $package['durationDays'] }} {{ str_plural(__('package::labels.days'), $package['durationDays']) }}
                        </span>
                    </div>

                    <dl class="row small">
                        <dt class="col-6">{{ __('package::labels.daily_limit') }}</dt>
                        <dd class="col-6">{{ $package['dailyLimit'] }}</dd>

                        <dt class="col-6">{{ __('package::labels.monthly_limit') }}</dt>
                        <dd class="col-6">{{ $package['monthlyLimit'] }}</dd>
                    </dl>

                    <div class="mb-3">
                        <small class="text-muted">{{ __('package::labels.allowed_sites') }}:</small>
                        <div>
                            @foreach($package['allowedSites'] as $site)
                                <span class="badge bg-light text-dark me-1">
                                    {{ __('package::sites.' . str_replace(' ', '', $site)) }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    @auth
                        @if(auth()->user()->isAdmin())
                            <div class="mt-3">
                                <a href="{{ route('web.admin.packages.edit', $package['id']) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    {{ __('package::labels.edit_package') }}
                                </a>
                                <form action="{{ route('web.admin.packages.destroy', $package['id']) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        {{ __('package::labels.delete_package') }}
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info">
                {{ __('package::messages.no_packages') }}
            </div>
        </div>
        @endforelse
    </div>

    @auth
        @if(auth()->user()->isAdmin())
            <div class="mt-4">
                <a href="{{ route('web.admin.packages.create') }}" class="btn btn-primary">
                    {{ __('package::labels.create_package') }}
                </a>
            </div>
        @endif
    @endauth
</div>
@endsection

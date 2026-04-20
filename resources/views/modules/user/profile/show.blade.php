@extends('layouts.app')

@section('title', __('user::labels.profile'))

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ $user['avatar'] ?? asset('images/default-avatar.png') }}"
                         class="rounded-circle mb-3"
                         width="120"
                         height="120"
                         alt="{{ $user['name'] }}">
                    <h5>{{ $user['name'] }}</h5>
                    <p class="text-muted">{{ $user['email'] }}</p>
                    <span class="badge bg-{{ $user['role'] === 'admin' ? 'danger' : ($user['role'] === 'supervisor' ? 'warning' : 'secondary') }}">
                        {{ ucfirst($user['role']) }}
                    </span>
                    @if($user['isBanned'])
                        <span class="badge bg-danger ms-2">Banned</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">{{ __('user::labels.edit_profile') }}</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('web.user.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">{{ __('user::labels.name') }}</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $user['name']) }}">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('user::labels.email') }}</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email', $user['email']) }}">
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('user::labels.phone') }}</label>
                            <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                   value="{{ old('phone', $user['phone']) }}"
                                   placeholder="+9665XXXXXXXX">
                            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('user::labels.profession') }}</label>
                            <input type="text" name="profession" class="form-control"
                                   value="{{ old('profession', $user['profession']) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('user::labels.companySize') }}</label>
                            <select name="companySize" class="form-select">
                                <option value="">-- Select --</option>
                                <option value="1-10" {{ old('companySize', $user['companySize']) === '1-10' ? 'selected' : '' }}>1-10</option>
                                <option value="11-50" {{ old('companySize', $user['companySize']) === '11-50' ? 'selected' : '' }}>11-50</option>
                                <option value="51-200" {{ old('companySize', $user['companySize']) === '51-200' ? 'selected' : '' }}>51-200</option>
                                <option value="200+" {{ old('companySize', $user['companySize']) === '200+' ? 'selected' : '' }}>200+</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            {{ __('user::labels.save_changes') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('title', 'User Management')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Users</h5>
            <form method="GET" class="d-flex">
                <input type="text" name="search" class="form-control form-control-sm me-2"
                       placeholder="Search users..." value="{{ $search ?? '' }}">
                <button type="submit" class="btn btn-sm btn-primary">Search</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>
                            <img src="{{ $user['avatar'] ?? asset('images/default-avatar.png') }}"
                                 class="rounded-circle me-2" width="32" height="32">
                            {{ $user['name'] }}
                        </td>
                        <td>{{ $user['email'] }}</td>
                        <td>
                            <span class="badge bg-{{ $user['role'] === 'admin' ? 'danger' : ($user['role'] === 'supervisor' ? 'warning' : 'secondary') }}">
                                {{ ucfirst($user['role']) }}
                            </span>
                        </td>
                        <td>
                            @if($user['isBanned'])
                                <span class="badge bg-danger">Banned</span>
                            @else
                                <span class="badge bg-success">Active</span>
                            @endif
                        </td>
                        <td>{{ $user['createdAt'] }}</td>
                        <td>
                            <a href="{{ route('web.admin.users.show', $user['id']) }}"
                               class="btn btn-sm btn-info">View</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No users found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $users->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection

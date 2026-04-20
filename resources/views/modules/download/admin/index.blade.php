@extends('layouts.admin')

@section('title', 'Download Management')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">All Downloads</h5>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Site</th>
                        <th>File</th>
                        <th>Status</th>
                        <th>IP</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($downloads as $download)
                    <tr>
                        <td>{{ $download['user']['name'] ?? 'N/A' }}<br><small>{{ $download['user']['email'] }}</small></td>
                        <td>{{ $download['site'] }}</td>
                        <td>{{ $download['fileName'] ?? 'N/A' }}</td>
                        <td>
                            <span class="badge bg-{{ $download['status'] === 'completed' ? 'success' : ($download['status'] === 'failed' ? 'danger' : 'warning') }}">
                                {{ $download['status'] }}
                            </span>
                        </td>
                        <td><small>{{ $download['ip'] }}</small></td>
                        <td>{{ $download['date'] }}</td>
                        <td>
                            @if($download['status'] === 'completed')
                                <form action="{{ route('web.admin.downloads.destroy', $download['id']) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this record?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No downloads found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

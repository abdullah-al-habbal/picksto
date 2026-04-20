@extends('layouts.app')

@section('title', __('download::labels.history'))

@section('content')
<div class="container py-4">
    <h2 class="mb-4">{{ __('download::labels.history') }}</h2>

    @if($downloads->isEmpty())
        <div class="alert alert-info">
            {{ __('download::messages.no_downloads') }}
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>{{ __('download::labels.file_name') }}</th>
                        <th>{{ __('download::labels.site') }}</th>
                        <th>{{ __('download::labels.status') }}</th>
                        <th>{{ __('download::labels.date') }}</th>
                        <th>{{ __('download::labels.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($downloads as $download)
                    <tr>
                        <td>{{ $download['fileName'] ?? 'N/A' }}</td>
                        <td>{{ $download['site'] }}</td>
                        <td>
                            @if($download['status'] === 'completed')
                                <span class="badge bg-success">{{ $download['status'] }}</span>
                            @elseif($download['status'] === 'failed')
                                <span class="badge bg-danger">{{ $download['status'] }}</span>
                            @else
                                <span class="badge bg-warning text-dark">{{ $download['status'] }}</span>
                            @endif
                        </td>
                        <td>{{ $download['date'] }}</td>
                        <td>
                            @if($download['status'] === 'completed' && $download['downloadLink'])
                                <a href="{{ $download['downloadLink'] }}" class="btn btn-sm btn-primary">
                                    {{ __('download::labels.download') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection

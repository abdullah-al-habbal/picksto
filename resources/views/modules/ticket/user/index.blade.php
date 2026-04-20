@extends('layouts.app')
@section('title', __('ticket::labels.my_tickets'))
@section('content')
    <div class="container py-4">
        <h2 class="mb-4">{{ __('ticket::labels.my_tickets') }}</h2>
        @if($tickets->isEmpty())
            <div class="alert alert-info">{{ __('ticket::messages.no_tickets') }}</div>
        @else
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>{{ __('ticket::labels.subject') }}</th>
                            <th>{{ __('ticket::labels.status') }}</th>
                            <th>{{ __('ticket::labels.created_at') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tickets as $t)
                            <tr>
                                <td><a href="{{ route('web.tickets.show', $t['id']) }}">{{ $t['subject'] }}</a></td>
                                <td><span
                                        class="badge bg-{{ $t['status'] === 'open' ? 'success' : 'warning' }}">{{ __('ticket::labels.status_' . $t['status']) }}</span>
                                </td>
                                <td>{{ $t['createdAt'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
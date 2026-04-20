@extends('layouts.app')
@section('title', $data['subject'])
@section('content')
    <div class="container py-4">
        <div class="card mb-4">
            <div class="card-body">
                <h4>{{ $data['subject'] }}</h4>
                <p class="text-muted">{{ $data['message'] }}</p>
                <span
                    class="badge bg-{{ $data['status'] === 'open' ? 'success' : 'warning' }}">{{ __('ticket::labels.status_' . $data['status']) }}</span>
            </div>
        </div>

        <div class="mb-4">
            @foreach($data['replies'] as $reply)
                <div class="card mb-2 {{ $reply['isAdmin'] ? 'border-primary' : '' }}">
                    <div class="card-body">
                        <small class="text-muted">{{ $reply['user'] }} • {{ $reply['createdAt'] }}</small>
                        <p class="mt-2">{{ $reply['message'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <form action="{{ route('web.tickets.reply', $data['id']) }}" method="POST">
            @csrf
            <div class="mb-3">
                <textarea name="message" class="form-control @error('message') is-invalid @enderror" rows="3"
                    placeholder="{{ __('ticket::labels.reply_placeholder') }}"></textarea>
                @error('message') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <button type="submit" class="btn btn-primary">{{ __('ticket::labels.send_reply') }}</button>
        </form>
    </div>
@endsection
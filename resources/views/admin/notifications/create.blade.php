@extends('layouts.admin')

@section('title', __('app.send_instant_notification'))
@section('page-title', __('app.send_instant_notification'))

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.member-notifications.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">{{ __('app.notification_title') }}</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required maxlength="255">
                    @error('title')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="body" class="form-label">{{ __('app.notification_body') }}</label>
                    <textarea name="body" id="body" class="form-control" rows="5" required maxlength="5000">{{ old('body') }}</textarea>
                    @error('body')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <p class="text-muted small">{{ __('app.notification_send_all_members_hint') }}</p>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane ms-1"></i>
                    {{ __('app.send_instant_notification') }}
                </button>
            </form>
        </div>
    </div>

    @if ($recent->isNotEmpty())
        <div class="card">
            <div class="card-header">{{ __('app.recent_notifications') }}</div>
            <ul class="list-group list-group-flush">
                @foreach ($recent as $item)
                    <li class="list-group-item">
                        <strong>{{ $item->title }}</strong>
                        <p class="mb-0 small text-muted">{{ $item->body }}</p>
                        <span class="small">{{ $item->sent_at?->format('d/m/Y H:i') }} — {{ $item->creator?->name }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection

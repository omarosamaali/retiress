<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('app.my_panel') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/styleU.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>
<body>
    <x-guest-header></x-guest-header>

    <main class="member-panel-page">
        <h1 class="mb-4">{{ __('app.my_panel') }}</h1>

        <div class="member-panel-grid">
            <section class="member-panel-card">
                <h3>{{ __('app.subscribed_events') }}</h3>
                @forelse ($subscribedTransactions as $transaction)
                    @if ($transaction->event)
                        <div class="border-bottom pb-2 mb-2">
                            <a href="{{ route('events.show', $transaction->event) }}">
                                <strong>{{ app()->getLocale() == 'ar' ? $transaction->event->title_ar : $transaction->event->title_en }}</strong>
                            </a>
                            <div class="small text-muted mt-1">
                                <span class="badge {{ $transaction->status_badge_class }}">{{ $transaction->status_label }}</span>
                            </div>
                        </div>
                    @endif
                @empty
                    <p class="text-muted small mb-0">{{ __('app.no_subscribed_events') }}</p>
                @endforelse
            </section>

            <section class="member-panel-card">
                <h3>{{ __('app.available_events') }}</h3>
                @forelse ($availableEvents as $event)
                    <div class="border-bottom pb-2 mb-2">
                        <a href="{{ route('events.show', $event) }}">
                            <strong>{{ app()->getLocale() == 'ar' ? $event->title_ar : $event->title_en }}</strong>
                        </a>
                        <div class="mt-1">
                            @include('members.events.partials.event-meta', ['event' => $event])
                        </div>
                    </div>
                @empty
                    <p class="text-muted small mb-0">{{ __('app.no_available_events') }}</p>
                @endforelse
            </section>
        </div>

        <section class="member-panel-card mt-4">
            <h3>{{ __('app.correspondence') }}</h3>
            @forelse ($recentMessages as $message)
                <div class="border-bottom pb-2 mb-2 small">
                    <strong>{{ $message->sender_id === auth()->id() ? __('app.you') : ($message->sender?->name ?? '—') }}</strong>
                    <p class="mb-0">{{ \Illuminate\Support\Str::limit($message->message, 100) }}</p>
                    <span class="text-muted">{{ $message->created_at?->diffForHumans() }}</span>
                </div>
            @empty
                <p class="text-muted small mb-2">{{ __('app.no_messages_yet') }}</p>
            @endforelse
            <a href="{{ route('chat') }}" class="btn btn-primary btn-sm">{{ __('app.open_correspondence') }}</a>
        </section>

        <section class="member-panel-card mt-4" id="notifications">
            <h3>{{ __('app.system_notifications') }}</h3>
            @forelse ($panelNotifications as $userNotification)
                <div class="border-bottom pb-2 mb-2 d-flex justify-content-between align-items-start gap-2">
                    <div>
                        <strong>{{ $userNotification->broadcast?->title }}</strong>
                        <p class="mb-0 small">{{ $userNotification->broadcast?->body }}</p>
                        <span class="text-muted small">{{ $userNotification->created_at?->diffForHumans() }}</span>
                    </div>
                    <button type="button" class="member-notification-dismiss btn btn-sm btn-outline-secondary"
                        data-dismiss-url="{{ route('members.notifications.dismiss', $userNotification) }}">×</button>
                </div>
            @empty
                <p class="text-muted small mb-0">{{ __('app.no_notifications') }}</p>
            @endforelse
        </section>
    </main>

    <x-footer-section></x-footer-section>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/member-header.js') }}" defer></script>
</body>
</html>

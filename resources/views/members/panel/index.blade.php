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
<body class="mp-body">
    <x-guest-header></x-guest-header>

    <div class="mp-page">

        {{-- Welcome bar --}}
        <div class="mp-welcome">
            <div class="mp-welcome__inner">
                <div class="mp-welcome__avatar">
                    <i class="fa-solid fa-circle-user"></i>
                </div>
                <div>
                    <div class="mp-welcome__greeting">{{ __('app.welcome') }}،</div>
                    <div class="mp-welcome__name">{{ auth()->user()->name }}</div>
                </div>
            </div>
            <div class="mp-welcome__stats">
                <div class="mp-stat">
                    <span class="mp-stat__num">{{ $subscribedTransactions->count() }}</span>
                    <span class="mp-stat__label">{{ __('app.subscribed_events') }}</span>
                </div>
                <div class="mp-stat">
                    <span class="mp-stat__num">{{ $recentMessages->count() }}</span>
                    <span class="mp-stat__label">{{ __('app.correspondence') }}</span>
                </div>
                <div class="mp-stat">
                    <span class="mp-stat__num">{{ $panelNotifications->count() }}</span>
                    <span class="mp-stat__label">{{ __('app.system_notifications') }}</span>
                </div>
            </div>
        </div>

        {{-- Events grid --}}
        <div class="mp-grid">

            {{-- Subscribed events --}}
            <div class="mp-card">
                <div class="mp-card__head">
                    <i class="fa-solid fa-ticket"></i>
                    <span>{{ __('app.subscribed_events') }}</span>
                </div>
                <div class="mp-card__body">
                    @forelse ($subscribedTransactions as $transaction)
                        @if ($transaction->event)
                            <a href="{{ route('events.show', $transaction->event) }}" class="mp-event-row">
                                <div class="mp-event-row__icon">
                                    <i class="fa-regular fa-calendar-check"></i>
                                </div>
                                <div class="mp-event-row__info">
                                    <div class="mp-event-row__title">
                                        {{ app()->getLocale() == 'ar' ? $transaction->event->title_ar : $transaction->event->title_en }}
                                    </div>
                                    @if ($transaction->event->display_starts_at)
                                        <div class="mp-event-row__date">
                                            <i class="fa-regular fa-clock"></i>
                                            {{ $transaction->event->display_starts_at->translatedFormat('d M Y') }}
                                        </div>
                                    @endif
                                </div>
                                <span class="mp-badge mp-badge--{{ $transaction->status }}">{{ $transaction->status_label }}</span>
                            </a>
                        @endif
                    @empty
                        <div class="mp-empty">
                            <i class="fa-regular fa-calendar-xmark"></i>
                            <span>{{ __('app.no_subscribed_events') }}</span>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Available events --}}
            <div class="mp-card">
                <div class="mp-card__head">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span>{{ __('app.available_events') }}</span>
                </div>
                <div class="mp-card__body">
                    @forelse ($availableEvents as $event)
                        <a href="{{ route('events.show', $event) }}" class="mp-event-row">
                            <div class="mp-event-row__icon mp-event-row__icon--green">
                                <i class="fa-regular fa-calendar"></i>
                            </div>
                            <div class="mp-event-row__info">
                                <div class="mp-event-row__title">
                                    {{ app()->getLocale() == 'ar' ? $event->title_ar : $event->title_en }}
                                </div>
                                <div class="mp-event-row__meta">
                                    @if ($event->display_starts_at)
                                        <span><i class="fa-regular fa-clock"></i> {{ $event->display_starts_at->translatedFormat('d M Y') }}</span>
                                    @endif
                                    <span class="mp-price">
                                        @if ($event->isFree())
                                            <i class="fa-solid fa-tag"></i> {{ __('app.free_event') }}
                                        @else
                                            <i class="fa-solid fa-tag"></i> {{ number_format((float) $event->price, 0) }} {{ __('app.aed') }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <i class="fa-solid fa-chevron-left mp-event-row__arrow"></i>
                        </a>
                    @empty
                        <div class="mp-empty">
                            <i class="fa-regular fa-calendar"></i>
                            <span>{{ __('app.no_available_events') }}</span>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>{{-- /mp-grid --}}

        {{-- Messages --}}
        <div class="mp-card mp-card--full">
            <div class="mp-card__head">
                <i class="fa-solid fa-envelope"></i>
                <span>{{ __('app.correspondence') }}</span>
                <a href="{{ route('chat') }}" class="mp-card__action">
                    {{ __('app.open_correspondence') }} <i class="fa-solid fa-arrow-left"></i>
                </a>
            </div>
            <div class="mp-card__body">
                @forelse ($recentMessages as $message)
                    <div class="mp-msg-row">
                        <div class="mp-msg-row__avatar">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="mp-msg-row__content">
                            <div class="mp-msg-row__name">
                                {{ $message->from_user_id === auth()->id() ? __('app.you') : ($message->sender?->name ?? '—') }}
                            </div>
                            <div class="mp-msg-row__text">{{ \Illuminate\Support\Str::limit($message->message, 120) }}</div>
                        </div>
                        <div class="mp-msg-row__time">{{ $message->created_at?->diffForHumans() }}</div>
                    </div>
                @empty
                    <div class="mp-empty">
                        <i class="fa-regular fa-envelope-open"></i>
                        <span>{{ __('app.no_messages_yet') }}</span>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Notifications --}}
        <div class="mp-card mp-card--full" id="notifications">
            <div class="mp-card__head">
                <i class="fa-solid fa-bell"></i>
                <span>{{ __('app.system_notifications') }}</span>
            </div>
            <div class="mp-card__body">
                @forelse ($panelNotifications as $userNotification)
                    <div class="mp-notif-row" data-id="{{ $userNotification->id }}">
                        <div class="mp-notif-row__icon">
                            <i class="fa-solid fa-circle-info"></i>
                        </div>
                        <div class="mp-notif-row__content">
                            <div class="mp-notif-row__title">{{ $userNotification->broadcast?->title }}</div>
                            <div class="mp-notif-row__body">{{ $userNotification->broadcast?->body }}</div>
                            <div class="mp-notif-row__time">{{ $userNotification->created_at?->diffForHumans() }}</div>
                        </div>
                        <button type="button" class="mp-dismiss member-notification-dismiss"
                            data-dismiss-url="{{ route('members.notifications.dismiss', $userNotification) }}"
                            title="{{ __('app.dismiss') }}">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                @empty
                    <div class="mp-empty">
                        <i class="fa-regular fa-bell-slash"></i>
                        <span>{{ __('app.no_notifications') }}</span>
                    </div>
                @endforelse
            </div>
        </div>

    </div>{{-- /mp-page --}}

    <x-footer-section></x-footer-section>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/member-header.js') }}" defer></script>
</body>
</html>

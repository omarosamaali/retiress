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
        @php
            $__panelApp    = auth()->user()->memberApplication;
            $__panelExpiry = $__panelApp?->expiration_date
                ? \Carbon\Carbon::parse($__panelApp->expiration_date)
                : null;
            $__panelExpStr = $__panelExpiry?->format('Y/m/d');
            $__panelDays   = $__panelExpiry ? max(0, (int) now()->diffInDays($__panelExpiry, false)) : null;
            $__panelIsExp  = $__panelExpiry && $__panelExpiry->isPast();
        @endphp
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
            @if ($__panelExpStr)
            <div class="mp-expiry-badge mp-expiry-badge--{{ $__panelIsExp ? 'expired' : ($__panelDays <= 30 ? 'expiring' : 'active') }}">
                <i class="fa-solid fa-calendar-xmark"></i>
                @if ($__panelIsExp)
                    انتهت العضوية {{ $__panelExpStr }}
                @else
                    تنتهي العضوية {{ $__panelExpStr }} - بعد
                    @if ($__panelDays !== null)
                        <span class="mp-expiry-days" style="color:white;">({{ $__panelDays }} يوم)</span>
                    @endif
                @endif
            </div>
            @endif
        </div>

        {{-- Stats row --}}
        <div class="mp-stats-row">
            <div class="mp-stat-card">
                <div class="mp-stat-card__icon" style="background:#e8f3ed;color:#016330"><i class="fa-solid fa-ticket"></i></div>
                <div class="mp-stat-card__body">
                    <div class="mp-stat-card__num">{{ $subscribedTransactions->count() }}</div>
                    <div class="mp-stat-card__label">{{ __('app.subscribed_events') }}</div>
                </div>
            </div>
            <div class="mp-stat-card">
                <div class="mp-stat-card__icon" style="background:#e8f0fe;color:#1a73e8"><i class="fa-solid fa-calendar-days"></i></div>
                <div class="mp-stat-card__body">
                    <div class="mp-stat-card__num">{{ $availableEvents->count() }}</div>
                    <div class="mp-stat-card__label">{{ __('app.available_events') }}</div>
                </div>
            </div>
            <div class="mp-stat-card">
                <div class="mp-stat-card__icon" style="background:#fff3e0;color:#f57c00"><i class="fa-solid fa-envelope"></i></div>
                <div class="mp-stat-card__body">
                    <div class="mp-stat-card__num">{{ $recentMessages->count() }}</div>
                    <div class="mp-stat-card__label">{{ __('app.correspondence') }}</div>
                </div>
            </div>
            <div class="mp-stat-card">
                <div class="mp-stat-card__icon" style="background:#fce4ec;color:#c2185b"><i class="fa-solid fa-bell"></i></div>
                <div class="mp-stat-card__body">
                    <div class="mp-stat-card__num">{{ $panelNotifications->count() }}</div>
                    <div class="mp-stat-card__label">{{ __('app.system_notifications') }}</div>
                </div>
            </div>
        </div>

        {{-- Quick actions --}}
        @auth
        @if(auth()->user()->isMemberRole())
        <div style="margin-bottom:20px;">
            <a href="{{ route('members.application.edit') }}"
                style="display:inline-flex; align-items:center; gap:8px; background:#016330; color:#fff; border-radius:10px; padding:10px 20px; text-decoration:none; font-size:.9rem; font-weight:600; transition:background .18s;"
                onmouseover="this.style.background='#014d25'" onmouseout="this.style.background='#016330'">
                <i class="fa-solid fa-pen-to-square"></i>
                تعديل بيانات طلب العضوية
            </a>
        </div>
        @else
        <div style="margin-bottom:20px;">
            <a href="{{ route('members.membership-show') }}"
                style="display:inline-flex; align-items:center; gap:8px; background:#b5933a; color:#fff; border-radius:10px; padding:10px 20px; text-decoration:none; font-size:.9rem; font-weight:600; transition:background .18s;"
                onmouseover="this.style.background='#8a6e2a'" onmouseout="this.style.background='#b5933a'">
                <i class="fa-solid fa-star"></i>
                اشتراك في العضوية
            </a>
        </div>
        @endif
        @endauth

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
                        @php
                            $__ev = $transaction->event;
                            $__typeColors = [
                                'دورة'   => ['bg'=>'#e8f0fe','color'=>'#1a73e8'],
                                'محاضرة' => ['bg'=>'#fff3e0','color'=>'#f57c00'],
                                'فعالية' => ['bg'=>'#e8f3ed','color'=>'#016330'],
                                'مميزات' => ['bg'=>'#fce4ec','color'=>'#c2185b'],
                            ];
                            $__tc = $__typeColors[$__ev->type_label] ?? ['bg'=>'#f1f5f9','color'=>'#475569'];
                        @endphp
                            <a href="{{ route('events.show', $__ev) }}" class="mp-event-row">
                                <div class="mp-event-row__icon">
                                    <i class="fa-regular fa-calendar-check"></i>
                                </div>
                                <div class="mp-event-row__info">
                                    <div class="mp-event-row__title">
                                        <span style="display:inline-block;font-size:10px;font-weight:700;padding:2px 7px;border-radius:4px;margin-left:5px;vertical-align:middle;background:{{ $__tc['bg'] }};color:{{ $__tc['color'] }};">{{ $__ev->type_label }}</span>
                                        {{ app()->getLocale() == 'ar' ? $__ev->title_ar : $__ev->title_en }}
                                    </div>
                                    <div class="mp-event-row__meta">
                                        @if ($__ev->display_starts_at)
                                            <span><i class="fa-regular fa-clock"></i> {{ $__ev->display_starts_at->format('d/m/Y — h:i A') }}</span>
                                        @endif
                                        @if ($__ev->display_ends_at)
                                            <span style="color:#e57373;"><i class="fa-regular fa-calendar-xmark"></i> ينتهي {{ $__ev->display_ends_at->format('d/m/Y') }}</span>
                                        @endif
                                    </div>
                                    <div style="display:flex;gap:6px;flex-wrap:wrap;margin-top:5px;">
                                        <span style="display:inline-flex;align-items:center;gap:4px;font-size:11px;font-weight:600;padding:3px 8px;border-radius:20px;background:{{ $__ev->isFree() ? '#e8f3ed' : '#fff3e0' }};color:{{ $__ev->isFree() ? '#016330' : '#b45309' }};">
                                            <i class="fa-solid fa-tag"></i>
                                            @if ($__ev->isFree()) {{ __('app.free_event') }}
                                            @else {{ number_format((float) $__ev->price, 0) }} <img src="{{ asset('assets/images/drhm.svg') }}" style="height:13px;width:auto;vertical-align:middle;margin-right:1px;">
                                            @endif
                                        </span>
                                        <span style="display:inline-flex;align-items:center;gap:4px;font-size:11px;font-weight:600;padding:3px 8px;border-radius:20px;background:{{ $__ev->isForMembersOnly() ? '#ede9fe' : '#f0f9ff' }};color:{{ $__ev->isForMembersOnly() ? '#6d28d9' : '#0369a1' }};">
                                            <i class="fa-solid fa-{{ $__ev->isForMembersOnly() ? 'id-card' : 'users' }}"></i>
                                            {{ $__ev->isForMembersOnly() ? 'للأعضاء فقط' : 'للجميع' }}
                                        </span>
                                        <span class="mp-badge mp-badge--{{ $transaction->status }}" style="font-size:11px;padding:3px 8px;">{{ $transaction->status_label }}</span>
                                    </div>
                                </div>
                                <i class="fa-solid fa-chevron-left mp-event-row__arrow"></i>
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
                        @php
                            $__typeColors = [
                                'دورة'   => ['bg'=>'#e8f0fe','color'=>'#1a73e8'],
                                'محاضرة' => ['bg'=>'#fff3e0','color'=>'#f57c00'],
                                'فعالية' => ['bg'=>'#e8f3ed','color'=>'#016330'],
                                'مميزات' => ['bg'=>'#fce4ec','color'=>'#c2185b'],
                            ];
                            $__tc = $__typeColors[$event->type_label] ?? ['bg'=>'#f1f5f9','color'=>'#475569'];
                        @endphp
                        <a href="{{ route('events.show', $event) }}" class="mp-event-row">
                            <div class="mp-event-row__icon mp-event-row__icon--green">
                                <i class="fa-regular fa-calendar"></i>
                            </div>
                            <div class="mp-event-row__info">
                                <div class="mp-event-row__title">
                                    <span style="display:inline-block;font-size:10px;font-weight:700;padding:2px 7px;border-radius:4px;margin-left:5px;vertical-align:middle;background:{{ $__tc['bg'] }};color:{{ $__tc['color'] }};">{{ $event->type_label }}</span>
                                    {{ app()->getLocale() == 'ar' ? $event->title_ar : $event->title_en }}
                                </div>
                                <div class="mp-event-row__meta">
                                    @if ($event->display_starts_at)
                                        <span><i class="fa-regular fa-clock"></i> {{ $event->display_starts_at->format('d/m/Y — h:i A') }}</span>
                                    @endif
                                    @if ($event->display_ends_at)
                                        <span style="color:#e57373;"><i class="fa-regular fa-calendar-xmark"></i> ينتهي {{ $event->display_ends_at->format('d/m/Y') }}</span>
                                    @endif
                                </div>
                                <div style="display:flex;gap:6px;flex-wrap:wrap;margin-top:5px;">
                                    <span style="display:inline-flex;align-items:center;gap:4px;font-size:11px;font-weight:600;padding:3px 8px;border-radius:20px;background:{{ $event->isFree() ? '#e8f3ed' : '#fff3e0' }};color:{{ $event->isFree() ? '#016330' : '#b45309' }};">
                                        <i class="fa-solid fa-tag"></i>
                                        @if ($event->isFree()) {{ __('app.free_event') }}
                                        @else {{ number_format((float) $event->price, 0) }} <img src="{{ asset('assets/images/drhm.svg') }}" style="height:13px;width:auto;vertical-align:middle;margin-right:1px;">
                                        @endif
                                    </span>
                                    <span style="display:inline-flex;align-items:center;gap:4px;font-size:11px;font-weight:600;padding:3px 8px;border-radius:20px;background:{{ $event->isForMembersOnly() ? '#ede9fe' : '#f0f9ff' }};color:{{ $event->isForMembersOnly() ? '#6d28d9' : '#0369a1' }};">
                                        <i class="fa-solid fa-{{ $event->isForMembersOnly() ? 'id-card' : 'users' }}"></i>
                                        {{ $event->isForMembersOnly() ? 'للأعضاء فقط' : 'للجميع' }}
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
    <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('assets/js/scriptU.js') }}"></script>
</body>
</html>

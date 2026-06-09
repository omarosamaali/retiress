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

        {{-- Stats — 10 cards, 5 per row --}}
        <style>
        .mp-stats-10 {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 12px;
            margin-bottom: 24px;
        }
        @media (max-width: 900px) {
            .mp-stats-10 { grid-template-columns: repeat(3, 1fr); }
        }
        @media (max-width: 600px) {
            .mp-stats-10 { grid-template-columns: repeat(2, 1fr); }
        }
        .mp-sc {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 6px;
            background: #fff;
            border-radius: 14px;
            padding: 16px 10px 14px;
            box-shadow: 0 1px 6px rgba(0,0,0,.07);
            cursor: pointer;
            text-decoration: none;
            transition: transform .15s, box-shadow .15s;
            border: 2px solid transparent;
        }
        .mp-sc:hover { transform: translateY(-3px); box-shadow: 0 4px 16px rgba(0,0,0,.12); text-decoration: none; }
        .mp-sc__icon {
            width: 44px; height: 44px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
        }
        .mp-sc__num {
            font-size: 22px; font-weight: 800; line-height: 1; color: #1e293b;
        }
        .mp-sc__label {
            font-size: 11px; font-weight: 600; color: #64748b; text-align: center; line-height: 1.3;
        }
        </style>
        <div class="mp-stats-10">
            {{-- 1 --}}
            <a href="#section-subscribed" class="mp-sc" style="border-color:#d1fae5;">
                <div class="mp-sc__icon" style="background:#e8f3ed;color:#016330;"><i class="fa-solid fa-ticket"></i></div>
                <div class="mp-sc__num" style="color:#016330;">{{ $stats['subscribed'] }}</div>
                <div class="mp-sc__label">إعلانات مشترك فيها</div>
            </a>
            {{-- 2 --}}
            <a href="#section-pending" class="mp-sc" style="border-color:#fde68a;">
                <div class="mp-sc__icon" style="background:#fffbeb;color:#b45309;"><i class="fa-solid fa-hourglass-half"></i></div>
                <div class="mp-sc__num" style="color:#b45309;">{{ $stats['pending'] }}</div>
                <div class="mp-sc__label">إعلانات قيد الانتظار</div>
            </a>
            {{-- 3 --}}
            <a href="#section-available" class="mp-sc" style="border-color:#bfdbfe;">
                <div class="mp-sc__icon" style="background:#e8f0fe;color:#1a73e8;"><i class="fa-solid fa-calendar-days"></i></div>
                <div class="mp-sc__num" style="color:#1a73e8;">{{ $stats['available'] }}</div>
                <div class="mp-sc__label">إعلانات متاحة للاشتراك</div>
            </a>
            {{-- 4 --}}
            <a href="#section-rejected" class="mp-sc" style="border-color:#fecaca;">
                <div class="mp-sc__icon" style="background:#fef2f2;color:#b91c1c;"><i class="fa-solid fa-circle-xmark"></i></div>
                <div class="mp-sc__num" style="color:#b91c1c;">{{ $stats['rejected'] }}</div>
                <div class="mp-sc__label">إعلانات مرفوضة</div>
            </a>
            {{-- 5 --}}
            <a href="#section-expired" class="mp-sc" style="border-color:#e2e8f0;">
                <div class="mp-sc__icon" style="background:#f1f5f9;color:#475569;"><i class="fa-solid fa-calendar-minus"></i></div>
                <div class="mp-sc__num" style="color:#475569;">{{ $stats['expired_tx'] }}</div>
                <div class="mp-sc__label">إعلانات منتهية</div>
            </a>
            {{-- 6 --}}
            <a href="#section-missed" class="mp-sc" style="border-color:#fed7aa;">
                <div class="mp-sc__icon" style="background:#fff7ed;color:#c2410c;"><i class="fa-solid fa-calendar-xmark"></i></div>
                <div class="mp-sc__num" style="color:#c2410c;">{{ $stats['missed'] }}</div>
                <div class="mp-sc__label">إعلانات لم أشترك بها</div>
            </a>
            {{-- 7 --}}
            <a href="#section-notif-read" class="mp-sc" style="border-color:#d1d5db;">
                <div class="mp-sc__icon" style="background:#f8fafc;color:#6b7280;"><i class="fa-regular fa-bell-slash"></i></div>
                <div class="mp-sc__num" style="color:#6b7280;">{{ $stats['notif_read'] }}</div>
                <div class="mp-sc__label">إشعارات رأيتها</div>
            </a>
            {{-- 8 --}}
            <a href="#section-notif-unread" class="mp-sc" style="border-color:#fde68a;">
                <div class="mp-sc__icon" style="background:#fefce8;color:#ca8a04;"><i class="fa-solid fa-bell"></i></div>
                <div class="mp-sc__num" style="color:#ca8a04;">{{ $stats['notif_unread'] }}</div>
                <div class="mp-sc__label">إشعارات لم أراها</div>
            </a>
            {{-- 9 --}}
            <a href="#section-notif-unread" class="mp-sc" style="border-color:#ddd6fe;">
                <div class="mp-sc__icon" style="background:#ede9fe;color:#6d28d9;"><i class="fa-solid fa-bell-concierge"></i></div>
                <div class="mp-sc__num" style="color:#6d28d9;">{{ $stats['notif_total'] }}</div>
                <div class="mp-sc__label">إشعارات جديدة</div>
            </a>
            {{-- 10 --}}
            <a href="{{ route('members.panel.invoices') }}" class="mp-sc" style="border-color:#a7f3d0;">
                <div class="mp-sc__icon" style="background:#ecfdf5;color:#059669;"><i class="fa-solid fa-file-invoice-dollar"></i></div>
                <div class="mp-sc__num" style="color:#059669;">{{ $stats['invoices'] }}</div>
                <div class="mp-sc__label">فواتيري</div>
            </a>
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
            <div class="mp-card" id="section-subscribed">
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
                                'خدمات'  => ['bg'=>'#fce4ec','color'=>'#c2185b'],
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
                                            <span style="color:#e57373;"><i class="fa-regular fa-calendar-xmark"></i> ينتهي {{ $__ev->display_ends_at->format('d/m/Y — h:i A') }}</span>
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
            <div class="mp-card" id="section-available">
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
                                'خدمات'  => ['bg'=>'#fce4ec','color'=>'#c2185b'],
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
                                        <span style="color:#e57373;"><i class="fa-regular fa-calendar-xmark"></i> ينتهي {{ $event->display_ends_at->format('d/m/Y — h:i A') }}</span>
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

        {{-- Pending + Rejected grid --}}
        @php
            $__txTypeColors = [
                'دورة'   => ['bg'=>'#e8f0fe','color'=>'#1a73e8'],
                'محاضرة' => ['bg'=>'#fff3e0','color'=>'#f57c00'],
                'فعالية' => ['bg'=>'#e8f3ed','color'=>'#016330'],
                'خدمات'  => ['bg'=>'#fce4ec','color'=>'#c2185b'],
            ];
        @endphp
        <div class="mp-grid">

            {{-- Pending events --}}
            <div class="mp-card" id="section-pending">
                <div class="mp-card__head" style="background:#fff8e1;color:#b45309;border-bottom:2px solid #fde68a;">
                    <i class="fa-solid fa-hourglass-half"></i>
                    <span>إعلانات قيد الانتظار</span>
                    @if($pendingTransactions->count())
                        <span style="margin-right:auto;background:#fde68a;color:#b45309;font-size:11px;font-weight:700;padding:2px 8px;border-radius:20px;">{{ $pendingTransactions->count() }}</span>
                    @endif
                </div>
                <div class="mp-card__body">
                    @forelse ($pendingTransactions as $transaction)
                        @if ($transaction->event)
                        @php $__ev = $transaction->event; $__tc = $__txTypeColors[$__ev->type_label] ?? ['bg'=>'#f1f5f9','color'=>'#475569']; @endphp
                        <a href="{{ route('events.show', $__ev) }}" class="mp-event-row">
                            <div class="mp-event-row__icon" style="background:#fff8e1;color:#b45309;">
                                <i class="fa-regular fa-hourglass"></i>
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
                                        <span style="color:#e57373;"><i class="fa-regular fa-calendar-xmark"></i> ينتهي {{ $__ev->display_ends_at->format('d/m/Y — h:i A') }}</span>
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
                                    <span style="display:inline-flex;align-items:center;gap:4px;font-size:11px;font-weight:600;padding:3px 8px;border-radius:20px;background:#fff8e1;color:#b45309;">
                                        <i class="fa-solid fa-hourglass-half"></i> {{ $transaction->status_label }}
                                    </span>
                                </div>
                            </div>
                            <i class="fa-solid fa-chevron-left mp-event-row__arrow"></i>
                        </a>
                        @endif
                    @empty
                        <div class="mp-empty">
                            <i class="fa-regular fa-hourglass"></i>
                            <span>لا توجد إعلانات قيد الانتظار</span>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Rejected events --}}
            <div class="mp-card" id="section-rejected">
                <div class="mp-card__head" style="background:#fef2f2;color:#b91c1c;border-bottom:2px solid #fecaca;">
                    <i class="fa-solid fa-circle-xmark"></i>
                    <span>إعلانات مرفوضة / منتهية</span>
                    @if($rejectedTransactions->count())
                        <span style="margin-right:auto;background:#fecaca;color:#b91c1c;font-size:11px;font-weight:700;padding:2px 8px;border-radius:20px;">{{ $rejectedTransactions->count() }}</span>
                    @endif
                </div>
                <div class="mp-card__body">
                    @forelse ($rejectedTransactions as $transaction)
                        @if ($transaction->event)
                        @php $__ev = $transaction->event; $__tc = $__txTypeColors[$__ev->type_label] ?? ['bg'=>'#f1f5f9','color'=>'#475569']; @endphp
                        <a href="{{ route('events.show', $__ev) }}" class="mp-event-row" style="opacity:0.75;">
                            <div class="mp-event-row__icon" style="background:#fef2f2;color:#b91c1c;">
                                <i class="fa-regular fa-calendar-xmark"></i>
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
                                        <span style="color:#e57373;"><i class="fa-regular fa-calendar-xmark"></i> ينتهي {{ $__ev->display_ends_at->format('d/m/Y — h:i A') }}</span>
                                    @endif
                                </div>
                                <div style="display:flex;gap:6px;flex-wrap:wrap;margin-top:5px;">
                                    <span style="display:inline-flex;align-items:center;gap:4px;font-size:11px;font-weight:600;padding:3px 8px;border-radius:20px;background:{{ $__ev->isFree() ? '#e8f3ed' : '#fff3e0' }};color:{{ $__ev->isFree() ? '#016630' : '#b45309' }};">
                                        <i class="fa-solid fa-tag"></i>
                                        @if ($__ev->isFree()) {{ __('app.free_event') }}
                                        @else {{ number_format((float) $__ev->price, 0) }} <img src="{{ asset('assets/images/drhm.svg') }}" style="height:13px;width:auto;vertical-align:middle;margin-right:1px;">
                                        @endif
                                    </span>
                                    <span style="display:inline-flex;align-items:center;gap:4px;font-size:11px;font-weight:600;padding:3px 8px;border-radius:20px;background:#fef2f2;color:#b91c1c;">
                                        <i class="fa-solid fa-circle-xmark"></i> {{ $transaction->status_label }}
                                    </span>
                                </div>
                            </div>
                            <i class="fa-solid fa-chevron-left mp-event-row__arrow"></i>
                        </a>
                        @endif
                    @empty
                        <div class="mp-empty">
                            <i class="fa-regular fa-calendar-xmark"></i>
                            <span>لا توجد إعلانات مرفوضة</span>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>{{-- /mp-grid pending+rejected --}}

        {{-- Expired + Missed grid --}}
        <div class="mp-grid">

            {{-- Expired transactions --}}
            <div class="mp-card" id="section-expired">
                <div class="mp-card__head" style="background:#f1f5f9;color:#475569;border-bottom:2px solid #e2e8f0;">
                    <i class="fa-solid fa-calendar-minus"></i>
                    <span>إعلانات منتهية</span>
                    @if($expiredTransactions->count())
                        <span style="margin-right:auto;background:#e2e8f0;color:#475569;font-size:11px;font-weight:700;padding:2px 8px;border-radius:20px;">{{ $expiredTransactions->count() }}</span>
                    @endif
                </div>
                <div class="mp-card__body">
                    @forelse ($expiredTransactions as $transaction)
                        @if ($transaction->event)
                        @php $__ev = $transaction->event; $__tc2 = $__txTypeColors[$__ev->type_label] ?? ['bg'=>'#f1f5f9','color'=>'#475569']; @endphp
                        <a href="{{ route('events.show', $__ev) }}" class="mp-event-row" style="opacity:0.7;">
                            <div class="mp-event-row__icon" style="background:#f1f5f9;color:#64748b;">
                                <i class="fa-regular fa-calendar-minus"></i>
                            </div>
                            <div class="mp-event-row__info">
                                <div class="mp-event-row__title">
                                    <span style="display:inline-block;font-size:10px;font-weight:700;padding:2px 7px;border-radius:4px;margin-left:5px;vertical-align:middle;background:{{ $__tc2['bg'] }};color:{{ $__tc2['color'] }};">{{ $__ev->type_label }}</span>
                                    {{ app()->getLocale() == 'ar' ? $__ev->title_ar : $__ev->title_en }}
                                </div>
                                <div class="mp-event-row__meta">
                                    @if ($__ev->display_ends_at)
                                        <span style="color:#94a3b8;"><i class="fa-regular fa-calendar-xmark"></i> انتهى {{ $__ev->display_ends_at->format('d/m/Y') }}</span>
                                    @endif
                                </div>
                                <div style="display:flex;gap:6px;flex-wrap:wrap;margin-top:5px;">
                                    <span style="display:inline-flex;align-items:center;gap:4px;font-size:11px;font-weight:600;padding:3px 8px;border-radius:20px;background:#f1f5f9;color:#64748b;">
                                        <i class="fa-solid fa-calendar-minus"></i> {{ $transaction->status_label }}
                                    </span>
                                </div>
                            </div>
                            <i class="fa-solid fa-chevron-left mp-event-row__arrow"></i>
                        </a>
                        @endif
                    @empty
                        <div class="mp-empty">
                            <i class="fa-regular fa-calendar"></i>
                            <span>لا توجد إعلانات منتهية</span>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Missed events (ended without subscribing) --}}
            <div class="mp-card" id="section-missed">
                <div class="mp-card__head" style="background:#fff7ed;color:#c2410c;border-bottom:2px solid #fed7aa;">
                    <i class="fa-solid fa-calendar-xmark"></i>
                    <span>إعلانات لم أشترك بها</span>
                    @if($missedEvents->count())
                        <span style="margin-right:auto;background:#fed7aa;color:#c2410c;font-size:11px;font-weight:700;padding:2px 8px;border-radius:20px;">{{ $missedEvents->count() }}</span>
                    @endif
                </div>
                <div class="mp-card__body">
                    @forelse ($missedEvents as $event)
                        @php $__tc3 = $__txTypeColors[$event->type_label] ?? ['bg'=>'#f1f5f9','color'=>'#475569']; @endphp
                        <div class="mp-event-row" style="opacity:0.75;cursor:default;">
                            <div class="mp-event-row__icon" style="background:#fff7ed;color:#c2410c;">
                                <i class="fa-regular fa-calendar-xmark"></i>
                            </div>
                            <div class="mp-event-row__info">
                                <div class="mp-event-row__title">
                                    <span style="display:inline-block;font-size:10px;font-weight:700;padding:2px 7px;border-radius:4px;margin-left:5px;vertical-align:middle;background:{{ $__tc3['bg'] }};color:{{ $__tc3['color'] }};">{{ $event->type_label }}</span>
                                    {{ app()->getLocale() == 'ar' ? $event->title_ar : $event->title_en }}
                                </div>
                                <div class="mp-event-row__meta">
                                    @if ($event->display_ends_at)
                                        <span style="color:#f97316;"><i class="fa-regular fa-calendar-xmark"></i> انتهى {{ $event->display_ends_at->format('d/m/Y') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="mp-empty">
                            <i class="fa-regular fa-calendar"></i>
                            <span>لا توجد إعلانات فائتة</span>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>{{-- /mp-grid expired+missed --}}

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

        {{-- Notifications — unread --}}
        <div class="mp-card mp-card--full" id="section-notif-unread">
            <div class="mp-card__head" style="background:#fefce8;color:#ca8a04;border-bottom:2px solid #fde68a;">
                <i class="fa-solid fa-bell"></i>
                <span>إشعارات لم أراها</span>
                @if($unreadNotifications->count())
                    <span class="notif-count-badge" style="margin-right:auto;background:#fde68a;color:#ca8a04;font-size:11px;font-weight:700;padding:2px 8px;border-radius:20px;">{{ $unreadNotifications->count() }}</span>
                @endif
            </div>
            <div class="mp-card__body">
                @forelse ($unreadNotifications as $userNotification)
                    <div class="mp-notif-row" data-id="{{ $userNotification->id }}">
                        <div class="mp-notif-row__icon" style="background:#fefce8;color:#ca8a04;">
                            <i class="fa-solid fa-bell"></i>
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
                        <span>لا توجد إشعارات غير مقروءة</span>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Notifications — read --}}
        <div class="mp-card mp-card--full" id="section-notif-read">
            <div class="mp-card__head">
                <i class="fa-regular fa-bell-slash"></i>
                <span>إشعارات رأيتها</span>
                @if($readNotifications->count())
                    <span class="notif-count-badge" style="margin-right:auto;background:#e2e8f0;color:#475569;font-size:11px;font-weight:700;padding:2px 8px;border-radius:20px;">{{ $readNotifications->count() }}</span>
                @endif
            </div>
            <div class="mp-card__body">
                @forelse ($readNotifications->take(10) as $userNotification)
                    <div class="mp-notif-row" style="opacity:0.7;" data-id="{{ $userNotification->id }}">
                        <div class="mp-notif-row__icon">
                            <i class="fa-solid fa-circle-info"></i>
                        </div>
                        <div class="mp-notif-row__content">
                            <div class="mp-notif-row__title">{{ $userNotification->broadcast?->title }}</div>
                            <div class="mp-notif-row__body">{{ $userNotification->broadcast?->body }}</div>
                            <div class="mp-notif-row__time">{{ $userNotification->created_at?->diffForHumans() }}</div>
                        </div>
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
    <script>
    document.querySelectorAll('.mp-dismiss.member-notification-dismiss').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var url  = btn.dataset.dismissUrl;
            var row  = btn.closest('.mp-notif-row');
            var card = btn.closest('.mp-card__body');
            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                }
            }).then(function(res) {
                if (res.ok) {
                    row.style.transition = 'opacity .3s';
                    row.style.opacity = '0';
                    setTimeout(function() {
                        row.remove();
                        // show empty if no rows left
                        if (!card.querySelector('.mp-notif-row')) {
                            card.innerHTML = '<div class="mp-empty"><i class="fa-regular fa-bell-slash"></i><span>لا توجد إشعارات</span></div>';
                        }
                    }, 300);
                }
            });
        });
    });
    </script>
</body>
</html>

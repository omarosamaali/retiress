@php
    $event = $events;

    $typeBadgeColor = match($event->type) {
        'دورة'    => ['bg'=>'#dbeafe','color'=>'#1d4ed8'],
        'محاضرة'  => ['bg'=>'#fef9c3','color'=>'#854d0e'],
        'خدمات','مميزات' => ['bg'=>'#fce7f3','color'=>'#9d174d'],
        default   => ['bg'=>'#dcfce7','color'=>'#166534'],
    };
    $audienceBadge = $event->isForMembersOnly()
        ? ['bg'=>'#e0f2fe','color'=>'#0369a1']
        : ['bg'=>'#f0fdf4','color'=>'#166534'];
@endphp

{{-- شريط النوع والفئة --}}
<div style="display:flex;flex-wrap:wrap;gap:8px;align-items:center;margin-bottom:18px;">
    <span style="background:{{ $typeBadgeColor['bg'] }};color:{{ $typeBadgeColor['color'] }};padding:3px 12px;border-radius:20px;font-size:.78rem;font-weight:700;">
        <i class="fa-solid fa-tag" style="margin-left:4px;"></i>{{ $event->type_label }}
    </span>
    <span style="background:{{ $audienceBadge['bg'] }};color:{{ $audienceBadge['color'] }};padding:3px 12px;border-radius:20px;font-size:.78rem;font-weight:700;">
        <i class="fa-solid fa-users" style="margin-left:4px;"></i>{{ $event->audience_label }}
    </span>
</div>

{{-- رسالة نجاح الاشتراك --}}
@if (session('success'))
<div style="background:#f0fdf4;border:1.5px solid #86efac;border-radius:10px;padding:16px 18px;margin-bottom:16px;">
    <div style="display:flex;align-items:center;gap:8px;margin-bottom:8px;">
        <i class="fa-solid fa-circle-check" style="color:#16a34a;font-size:1.1rem;"></i>
        <span style="font-weight:700;color:#15803d;font-size:.95rem;">{{ session('success') }}</span>
    </div>
    <div style="font-size:.82rem;color:#166534;margin-bottom:4px;">{{ __('app.event_subscription_success_detail') }}</div>
    @if (session('subscription_registered_at'))
    <div style="font-size:.82rem;color:#374151;">
        <i class="fa-regular fa-calendar" style="margin-left:4px;color:#16a34a;"></i>
        {{ __('app.subscription_date') }}: <strong>{{ session('subscription_registered_at') }}</strong>
    </div>
    @endif
    @if (session('subscription_status_label'))
    <div style="font-size:.82rem;color:#374151;margin-top:2px;">
        <i class="fa-solid fa-circle-dot" style="margin-left:4px;color:#16a34a;"></i>
        {{ __('app.subscription_status') }}: <strong>{{ session('subscription_status_label') }}</strong>
    </div>
    @endif
    <a href="{{ route('members.record') }}" style="display:inline-flex;align-items:center;gap:5px;margin-top:10px;font-size:.82rem;color:#16a34a;font-weight:600;text-decoration:none;">
        <i class="fa-solid fa-list"></i> {{ __('app.view_transaction_record') }}
    </a>
</div>
@endif

{{-- رسالة خطأ --}}
@if (session('error'))
<div style="background:#fef2f2;border:1.5px solid #fca5a5;border-radius:10px;padding:14px 16px;margin-bottom:16px;color:#b91c1c;font-size:.88rem;">
    <i class="fa-solid fa-circle-exclamation" style="margin-left:6px;"></i>{{ session('error') }}
</div>
@endif

{{-- غير مسجل --}}
@guest
<div style="background:#fffbeb;border:1.5px dashed #fcd34d;border-radius:10px;padding:18px;text-align:center;margin-bottom:8px;">
    <i class="fa-solid fa-lock" style="font-size:1.5rem;color:#d97706;margin-bottom:8px;display:block;"></i>
    <p style="margin:0 0 10px;font-size:.9rem;color:#92400e;font-weight:600;">{{ __('app.request_to_join_please') }}</p>
    <div style="display:flex;justify-content:center;gap:10px;flex-wrap:wrap;">
        <a href="{{ route('login') }}" style="background:#b68a35;color:#fff;padding:7px 20px;border-radius:8px;font-size:.85rem;font-weight:700;text-decoration:none;">
            <i class="fa-solid fa-right-to-bracket" style="margin-left:5px;"></i>{{ __('app.login') }}
        </a>
        <a href="{{ route('members.register') }}" style="background:#f3f4f6;color:#374151;padding:7px 20px;border-radius:8px;font-size:.85rem;font-weight:700;text-decoration:none;border:1px solid #d1d5db;">
            {{ __('app.register_membership') }}
        </a>
    </div>
</div>
@endguest

@auth
    {{-- بيانات اشتراك قائم --}}
    @if ($userSubscription)
    @php
        $isExpired = $userSubscription->isExpiredSubscription();
        $cardBg    = $isExpired ? '#fffbeb' : '#f0f9ff';
        $cardBorder = $isExpired ? '#fcd34d' : '#7dd3fc';
        $iconColor  = $isExpired ? '#d97706' : '#0284c7';
    @endphp
    <div style="background:{{ $cardBg }};border:1.5px solid {{ $cardBorder }};border-radius:12px;padding:18px 20px;margin-bottom:12px;">
        <div style="display:flex;align-items:center;gap:8px;margin-bottom:14px;border-bottom:1px solid {{ $cardBorder }};padding-bottom:10px;">
            <i class="fa-solid fa-id-card" style="color:{{ $iconColor }};font-size:1.1rem;"></i>
            <span style="font-weight:700;font-size:.95rem;color:#1e293b;">{{ __('app.your_subscription_for_this_event') }}</span>
        </div>
        <div style="display:flex;flex-direction:column;gap:9px;">
            <div style="display:flex;align-items:center;gap:8px;font-size:.87rem;color:#374151;">
                <i class="fa-regular fa-calendar" style="color:{{ $iconColor }};width:16px;text-align:center;"></i>
                <span style="color:#6b7280;">{{ __('app.subscription_date') }}:</span>
                <strong>{{ \Carbon\Carbon::parse($userSubscription->subscribed_at)->translatedFormat('d/m/Y - h:i A') }}</strong>
            </div>
            <div style="display:flex;align-items:center;gap:8px;font-size:.87rem;color:#374151;">
                <i class="fa-solid fa-circle-dot" style="color:{{ $iconColor }};width:16px;text-align:center;"></i>
                <span style="color:#6b7280;">{{ __('app.subscription_status') }}:</span>
                <span style="background:{{ $isExpired ? '#fef3c7' : '#dbeafe' }};color:{{ $isExpired ? '#92400e' : '#1d4ed8' }};padding:2px 10px;border-radius:20px;font-size:.78rem;font-weight:700;">
                    {{ $userSubscription->status_label }}
                </span>
            </div>
            <div style="display:flex;align-items:center;gap:8px;font-size:.87rem;color:#374151;">
                <i class="fa-solid fa-users" style="color:{{ $iconColor }};width:16px;text-align:center;"></i>
                <span style="color:#6b7280;">{{ __('app.announcement_audience') }}:</span>
                <strong>{{ $event->audience_label }}</strong>
            </div>
        </div>
        @if ($isExpired)
        <p style="margin:12px 0 0;font-size:.8rem;color:#92400e;background:#fef9c3;border-radius:6px;padding:6px 10px;">
            <i class="fa-solid fa-rotate-right" style="margin-left:4px;"></i>{{ __('app.subscription_expired_can_resubscribe') }}
        </p>
        @endif
        <div style="margin-top:14px;border-top:1px solid {{ $cardBorder }};padding-top:10px;">
            <a href="{{ route('members.record') }}" style="display:inline-flex;align-items:center;gap:6px;font-size:.83rem;font-weight:600;color:{{ $iconColor }};text-decoration:none;">
                <i class="fa-solid fa-list"></i>{{ __('app.view_transaction_record') }}
            </a>
        </div>
    </div>
    @endif

    {{-- إعلان منتهٍ --}}
    @if ($events->isExpired() && ! ($userSubscription && $userSubscription->isOpenSubscription()))
    <div style="background:#f9fafb;border:1.5px solid #d1d5db;border-radius:10px;padding:14px 16px;text-align:center;">
        <i class="fa-solid fa-clock" style="color:#9ca3af;font-size:1.3rem;margin-bottom:6px;display:block;"></i>
        <p style="margin:0;font-size:.88rem;color:#6b7280;font-weight:600;">{{ __('app.event_expired_notice') }}</p>
    </div>

    {{-- زر الاشتراك --}}
    @elseif ($canSubscribe ?? false)
    @php
        $registrationClosed = $event->isRegistrationClosed();
        $deadlineTs         = $event->subscription_deadline_timestamp;
    @endphp

    {{-- countdown timer (يظهر فقط إذا في deadline لم ينته بعد) --}}
    @if ($event->subscription_deadline && ! $registrationClosed)
    <div id="reg-deadline-box" style="background:#fff7ed;border:1.5px solid #fed7aa;border-radius:10px;padding:12px 16px;margin-bottom:14px;display:flex;align-items:center;gap:12px;">
        <i class="fa-solid fa-hourglass-half" style="color:#ea580c;font-size:1.3rem;flex-shrink:0;"></i>
        <div>
            <div style="font-size:.8rem;color:#9a3412;font-weight:700;margin-bottom:4px;">ينتهي التسجيل خلال</div>
            <div id="reg-countdown" style="font-size:1.15rem;font-weight:800;color:#c2410c;letter-spacing:.04em;font-variant-numeric:tabular-nums;">--:--:--</div>
        </div>
    </div>
    @endif

    {{-- رسالة انتهاء التسجيل --}}
    @if ($registrationClosed)
    <div style="background:#fef2f2;border:1.5px solid #fca5a5;border-radius:10px;padding:14px 16px;text-align:center;margin-bottom:4px;">
        <i class="fa-solid fa-ban" style="color:#dc2626;font-size:1.3rem;margin-bottom:6px;display:block;"></i>
        <p style="margin:0;font-size:.9rem;color:#b91c1c;font-weight:700;">انتهى وقت التسجيل</p>
        <p style="margin:4px 0 0;font-size:.8rem;color:#6b7280;">
            أُغلق باب التسجيل في {{ \Carbon\Carbon::parse($event->subscription_deadline)->translatedFormat('d/m/Y - h:i A') }}
        </p>
    </div>
    @else
    <div style="background:#fffbeb;border:1.5px dashed #fcd34d;border-radius:12px;padding:18px 20px;text-align:center;">
        <p style="margin:0 0 6px;font-size:.83rem;color:#92400e;">{{ __('app.event_subscribe_active_membership_hint') }}</p>
        <p style="margin:0 0 14px;font-size:.83rem;color:#92400e;">
            @if ($event->isForMembersOnly())
                {{ __('app.event_subscribe_members_only_hint') }}
            @else
                {{ __('app.event_subscribe_public_hint') }}
            @endif
        </p>
        <form action="{{ route('events.subscribe', $event->id) }}" method="POST" style="display:inline;">
            @csrf
            <input type="hidden" name="type" value="event">
            <button type="submit" id="subscribe-btn"
                style="background:#b68a35;color:#fff;border:none;border-radius:10px;padding:10px 28px;font-size:.93rem;font-weight:700;cursor:pointer;font-family:'Cairo',sans-serif;display:inline-flex;align-items:center;gap:7px;transition:background .18s;"
                onmouseover="this.style.background='#8a6520'" onmouseout="this.style.background='#b68a35'">
                <i class="fa-solid fa-circle-plus"></i> {{ __('app.subscribe_to_service') }}
            </button>
        </form>
    </div>
    @endif

    @if ($deadlineTs)
    <script>
    (function(){
        var deadline = {{ $deadlineTs }} * 1000;
        var countdownEl = document.getElementById('reg-countdown');
        var subscribeBtn = document.getElementById('subscribe-btn');
        var deadlineBox = document.getElementById('reg-deadline-box');

        function tick() {
            var now = Date.now();
            var diff = deadline - now;

            if (diff <= 0) {
                // انتهى الوقت — أوقف الزر وأخفِ العداد
                if (subscribeBtn) {
                    subscribeBtn.disabled = true;
                    subscribeBtn.style.background = '#9ca3af';
                    subscribeBtn.style.cursor = 'not-allowed';
                    subscribeBtn.onmouseover = null;
                    subscribeBtn.onmouseout  = null;
                    subscribeBtn.innerHTML = '<i class="fa-solid fa-ban"></i> انتهى التسجيل';
                }
                if (deadlineBox) {
                    deadlineBox.style.background = '#fef2f2';
                    deadlineBox.style.borderColor = '#fca5a5';
                    deadlineBox.querySelector('i').style.color = '#dc2626';
                    deadlineBox.querySelector('div > div:first-child').textContent = 'انتهى التسجيل';
                    if (countdownEl) countdownEl.textContent = '00:00:00';
                }
                return;
            }

            var d  = Math.floor(diff / 86400000);
            var h  = Math.floor((diff % 86400000) / 3600000);
            var m  = Math.floor((diff % 3600000)  / 60000);
            var s  = Math.floor((diff % 60000)     / 1000);

            var text = (d > 0 ? d + ' يوم  ' : '')
                + String(h).padStart(2,'0') + ':'
                + String(m).padStart(2,'0') + ':'
                + String(s).padStart(2,'0');

            if (countdownEl) countdownEl.textContent = text;

            // تحذير آخر ساعة
            if (diff < 3600000 && deadlineBox) {
                deadlineBox.style.background = '#fef2f2';
                deadlineBox.style.borderColor = '#fca5a5';
                deadlineBox.querySelector('i').style.color = '#dc2626';
                if (countdownEl) countdownEl.style.color = '#dc2626';
            }

            setTimeout(tick, 1000);
        }

        tick();
    })();
    </script>
    @endif

    {{-- سبب الحجب --}}
    @elseif (! ($userSubscription && $userSubscription->isOpenSubscription()) && ($subscribeBlockReason ?? null))
    <div style="background:#fff7ed;border:1.5px solid #fdba74;border-radius:10px;padding:14px 16px;">
        <div style="display:flex;align-items:flex-start;gap:8px;">
            <i class="fa-solid fa-triangle-exclamation" style="color:#ea580c;margin-top:2px;"></i>
            <div>
                <div style="font-size:.88rem;color:#9a3412;font-weight:600;margin-bottom:4px;">
                    {{ __('app.event_subscribe_blocked_'.$subscribeBlockReason) }}
                </div>
                @if ($subscribeBlockReason === 'membership_inactive' && auth()->user()->memberApplication)
                <div style="font-size:.8rem;color:#7c2d12;margin-top:4px;">
                    {{ __('app.subscription_status') }}:
                    <span style="background:#fee2e2;color:#991b1b;padding:2px 8px;border-radius:10px;font-size:.76rem;font-weight:700;">
                        {{ auth()->user()->membership_status_text }}
                    </span>
                </div>
                @endif
                @if (in_array($subscribeBlockReason, ['members_only_audience','membership_required','membership_inactive','member_role_required'], true))
                <a href="{{ route('members.membership-show') }}" style="display:inline-flex;align-items:center;gap:5px;margin-top:8px;font-size:.82rem;color:#ea580c;font-weight:600;text-decoration:none;">
                    <i class="fa-solid fa-id-card"></i>{{ __('app.register_membership') }}
                </a>
                @endif
            </div>
        </div>
    </div>
    @endif
@endauth

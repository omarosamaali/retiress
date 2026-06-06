@if ($showMemberHeaderTools ?? false)
@php
    $cardStatus = $membershipCardPayload['status']['key'] ?? 'pending';
    $showRenewal = in_array($cardStatus, ['expiring', 'expired']);
    $daysLeft   = $membershipCardPayload['status']['days_left'] ?? null;
    $showDays   = $daysLeft !== null && in_array($cardStatus, ['active', 'expiring']);
@endphp
<div class="member-header-tools d-flex align-items-center gap-2 flex-wrap" style="margin-right: 12px;">

    {{-- بطاقتي --}}
    <div class="downapp">
        <button type="button" class="member-card-trigger" id="openMembershipCard"
            title="{{ __('app.membership_card') }}" aria-label="{{ __('app.membership_card') }}">
            <i class="fa-solid fa-id-card"></i> {{ __('app.my_card') }}
        </button>
    </div>

    {{-- لوحتي --}}
    <a href="{{ route('members.panel') }}" class="member-panel-link" style="gap: 5px !important;">
        <i class="fa-solid fa-table-cells-large"></i> {{ __('app.my_panel') }}
    </a>

    {{-- الإشعارات --}}
    <div class="member-notifications-wrap">
        <button style="padding: 3px 8px; gap: 5px !important;" type="button" class="member-notifications-btn" id="toggleMemberNotifications"
            aria-expanded="false" aria-label="{{ __('app.notifications') }}">
            <i class="fa-solid fa-bell"></i> {{ __('app.notifications') }}
            @if (($headerNotificationCount ?? 0) > 0)
                <span class="member-notifications-badge">{{ $headerNotificationCount > 99 ? '99+' : $headerNotificationCount }}</span>
            @endif
        </button>
    </div>

    {{-- زر التجديد (عند الانتهاء أو الاقتراب) --}}
    @if ($showRenewal)
        <a href="{{ route('members.my-membership') }}" class="member-renewal-btn">
            <i class="fa-solid fa-rotate-right"></i> {{ __('app.renewal') }}
        </a>
    @endif

    {{-- تاريخ انتهاء العضوية --}}
    @if (!empty($membershipCardPayload['expiration_date']) && $cardStatus !== 'expired')
        <span class="header-expiry-badge header-expiry-badge--{{ $cardStatus === 'expiring' ? 'expiring' : 'active' }}">
            <i class="fa-solid fa-clock"></i>
            {{ $membershipCardPayload['expiration_date'] }}
        </span>
    @endif

</div>
@endif

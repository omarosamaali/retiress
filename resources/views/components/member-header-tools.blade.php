@if ($showMemberHeaderTools ?? false)
    <div class="member-header-tools d-flex align-items-center gap-2 flex-wrap" style="margin-right: 12px;">
        <div class="downapp">
            <button style="padding: 11px 8px;" type="button" class="member-card-trigger" id="openMembershipCard"
                title="{{ __('app.membership_card') }}" aria-label="{{ __('app.membership_card') }}">
                <i class="fa-solid fa-id-card" ></i>
            </button>
        </div>

        <a href="{{ route('members.panel') }}" class="member-panel-link">{{ __('app.my_panel') }}</a>

        <div class="member-notifications-wrap">
            <button style="padding: 11px 8px;" type="button" class="member-notifications-btn" id="toggleMemberNotifications"
                aria-expanded="false" aria-label="{{ __('app.notifications') }}">
                <i class="fa-solid fa-bell"></i>
                @if (($headerNotificationCount ?? 0) > 0)
                    <span class="member-notifications-badge">{{ $headerNotificationCount > 99 ? '99+' : $headerNotificationCount }}</span>
                @endif
            </button>
        </div>
    </div>
@endif

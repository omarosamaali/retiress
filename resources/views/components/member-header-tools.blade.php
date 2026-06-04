@if ($showMemberHeaderTools ?? false)
    <div class="member-header-tools d-flex align-items-center gap-2 flex-wrap" style="margin-right: 12px;">
        <div class="downapp">
            <button type="button" class="member-card-trigger" id="openMembershipCard"
                title="{{ __('app.membership_card') }}" aria-label="{{ __('app.membership_card') }}">
                <i class="fa-solid fa-id-card"></i>
            </button>
        </div>

        <a href="{{ route('members.panel') }}" style="padding: 5px 8px !important;" class="member-panel-link">{{ __('app.my_panel') }}</a>

        <div class="member-notifications-wrap">
            <button type="button" class="member-notifications-btn" id="toggleMemberNotifications"
                aria-expanded="false" aria-label="{{ __('app.notifications') }}">
                <i class="fa-solid fa-bell"></i>
                @if (($headerNotificationCount ?? 0) > 0)
                    <span class="member-notifications-badge">{{ $headerNotificationCount > 99 ? '99+' : $headerNotificationCount }}</span>
                @endif
            </button>
        </div>

        {{-- Full-screen notifications panel --}}
        <div class="notif-screen" id="memberNotificationsDropdown" hidden aria-hidden="true">
            <div class="notif-screen__backdrop" id="closeMemberNotifications"></div>
            <div class="notif-screen__panel" role="dialog" aria-label="{{ __('app.notifications') }}">
                <div class="notif-screen__head">
                    <span class="notif-screen__title">
                        <i class="fa-solid fa-bell"></i>
                        {{ __('app.notifications') }}
                        @if (($headerNotificationCount ?? 0) > 0)
                            <span class="notif-screen__count">{{ $headerNotificationCount > 99 ? '99+' : $headerNotificationCount }}</span>
                        @endif
                    </span>
                    <button type="button" class="notif-screen__close" id="closeMemberNotificationsBtn" aria-label="{{ __('app.close') }}">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <div class="notif-screen__body">

                    @if (($unreadChatCount ?? 0) > 0)
                        <div class="notif-screen__section-title">{{ __('app.correspondence') }}</div>
                        <a href="{{ route('chat') }}" class="notif-screen__item notif-screen__item--chat">
                            <div class="notif-screen__item-icon">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div class="notif-screen__item-content">
                                <span class="notif-screen__item-title">{{ __('app.unread_messages_count', ['count' => $unreadChatCount]) }}</span>
                            </div>
                            <i class="fa-solid fa-chevron-left notif-screen__item-arrow"></i>
                        </a>
                    @endif

                    <div class="notif-screen__section-title">{{ __('app.system_notifications') }}</div>

                    @forelse ($headerNotifications ?? [] as $userNotification)
                        <div class="notif-screen__item" data-id="{{ $userNotification->id }}">
                            <div class="notif-screen__item-icon notif-screen__item-icon--bell">
                                <i class="fa-solid fa-circle-info"></i>
                            </div>
                            <div class="notif-screen__item-content">
                                <div class="notif-screen__item-title">{{ $userNotification->broadcast?->title }}</div>
                                <div class="notif-screen__item-body">{{ \Illuminate\Support\Str::limit($userNotification->broadcast?->body, 120) }}</div>
                                <div class="notif-screen__item-time">{{ $userNotification->created_at?->diffForHumans() }}</div>
                            </div>
                            <button type="button" class="notif-screen__dismiss member-notification-dismiss"
                                data-dismiss-url="{{ route('members.notifications.dismiss', $userNotification) }}"
                                title="{{ __('app.dismiss') }}">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                    @empty
                        <div class="notif-screen__empty">
                            <i class="fa-regular fa-bell-slash"></i>
                            <span>{{ __('app.no_notifications') }}</span>
                        </div>
                    @endforelse

                </div>

                <div class="notif-screen__footer">
                    <a href="{{ route('members.panel') }}#notifications" class="notif-screen__view-all">
                        {{ __('app.view_all_notifications') }}
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif

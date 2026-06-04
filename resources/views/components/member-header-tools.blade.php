@if ($showMemberHeaderTools ?? false)
    <div class="member-header-tools d-flex align-items-center gap-2 flex-wrap" style="margin-right: 12px;">
        <div class="downapp">
            <button type="button" class="member-card-trigger btn btn-link p-0 border-0" id="openMembershipCard"
                title="{{ __('app.membership_card') }}" aria-label="{{ __('app.membership_card') }}">
                <i class="fa-solid fa-id-card"></i>
            </button>
        </div>

        <a href="{{ route('members.panel') }}" class="member-panel-link">{{ __('app.my_panel') }}</a>

        <div class="member-notifications-wrap position-relative">
            <button type="button" class="member-notifications-btn btn btn-link p-0 border-0" id="toggleMemberNotifications"
                aria-expanded="false" aria-label="{{ __('app.notifications') }}">
                <i class="fa-solid fa-bell"></i>
                @if (($headerNotificationCount ?? 0) > 0)
                    <span class="member-notifications-badge">{{ $headerNotificationCount > 99 ? '99+' : $headerNotificationCount }}</span>
                @endif
            </button>

            <div class="member-notifications-dropdown" id="memberNotificationsDropdown" hidden>
                <div class="member-notifications-dropdown__header">
                    <strong>{{ __('app.notifications') }}</strong>
                    <button type="button" class="btn-close-dropdown" id="closeMemberNotifications" aria-label="{{ __('app.close') }}">×</button>
                </div>

                @if (($unreadChatCount ?? 0) > 0)
                    <div class="member-notifications-section">
                        <div class="member-notifications-section__title">{{ __('app.correspondence') }}</div>
                        <a href="{{ route('chat') }}" class="member-notification-item">
                            <span>{{ __('app.unread_messages_count', ['count' => $unreadChatCount]) }}</span>
                        </a>
                    </div>
                @endif

                <div class="member-notifications-section">
                    <div class="member-notifications-section__title">{{ __('app.system_notifications') }}</div>
                    @forelse ($headerNotifications ?? [] as $userNotification)
                        <div class="member-notification-item" data-id="{{ $userNotification->id }}">
                            <div class="member-notification-item__body">
                                <strong>{{ $userNotification->broadcast?->title }}</strong>
                                <p class="mb-0 small">{{ \Illuminate\Support\Str::limit($userNotification->broadcast?->body, 80) }}</p>
                                <span class="text-muted small">{{ $userNotification->created_at?->diffForHumans() }}</span>
                            </div>
                            <button type="button" class="member-notification-dismiss" data-dismiss-url="{{ route('members.notifications.dismiss', $userNotification) }}" title="{{ __('app.dismiss') }}">×</button>
                        </div>
                    @empty
                        <p class="member-notifications-empty small text-muted mb-0 px-2">{{ __('app.no_notifications') }}</p>
                    @endforelse
                </div>

                <a href="{{ route('members.panel') }}#notifications" class="member-notifications-view-all">{{ __('app.view_all_notifications') }}</a>
            </div>
        </div>
    </div>
@endif

@php
    $event = $events;
@endphp

<div class="event-subscription-box mb-3">
    <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
        <span class="text-muted small">{{ __('app.announcement_audience') }}:</span>
        <span class="badge {{ $event->isForMembersOnly() ? 'bg-info' : 'bg-dark' }}">
            {{ $event->audience_label }}
        </span>
        <span class="badge bg-secondary">{{ $event->type_label }}</span>
    </div>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <strong>{{ session('success') }}</strong>
            <div class="small">{{ __('app.event_subscription_success_detail') }}</div>
            @if (session('subscription_registered_at'))
                <div class="mt-2 small">
                    {{ __('app.subscription_date') }}:
                    <strong>{{ session('subscription_registered_at') }}</strong>
                </div>
            @endif
            @if (session('subscription_status_label'))
                <div class="small">
                    {{ __('app.subscription_status') }}:
                    <strong>{{ session('subscription_status_label') }}</strong>
                </div>
            @endif
            <div class="small mt-1">
                {{ __('app.announcement_audience') }}: <strong>{{ $event->audience_label }}</strong>
            </div>
            <div class="mt-2">
                <a href="{{ route('members.record') }}" class="alert-link">{{ __('app.view_transaction_record') }}</a>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
    @endif

    @guest
        <div class="p-gd6 bor-kyc warning-voa border-6a9 bw--bik mb-m36 text-m1o font-weight-s3h">
            {{ __('app.request_to_join_please') }}
            <a href="{{ route('login') }}">{{ __('app.login') }}</a>
            {{ __('app.or') }}
            <a href="{{ route('members.register') }}">{{ __('app.create_new_account') }}</a>
        </div>
    @endguest

    @auth
        @if ($userSubscription)
            <div class="alert {{ $userSubscription->isExpiredSubscription() ? 'alert-warning' : 'alert-info' }}" role="alert">
                <strong>{{ __('app.your_subscription_for_this_event') }}</strong>
                <ul class="mb-0 mt-2 ps-3">
                    <li>{{ __('app.subscription_date') }}:
                        <strong>{{ \Carbon\Carbon::parse($userSubscription->subscribed_at)->translatedFormat('d/m/Y - h:i A') }}</strong>
                    </li>
                    <li>{{ __('app.subscription_status') }}:
                        <span class="badge {{ $userSubscription->status_badge_class }}">{{ $userSubscription->status_label }}</span>
                    </li>
                    <li>{{ __('app.announcement_audience') }}: <strong>{{ $event->audience_label }}</strong></li>
                </ul>
                @if ($userSubscription->isExpiredSubscription())
                    <p class="mb-0 mt-2 small">{{ __('app.subscription_expired_can_resubscribe') }}</p>
                @endif
                <div class="mt-2">
                    <a href="{{ route('members.record') }}">{{ __('app.view_transaction_record') }}</a>
                </div>
            </div>
        @endif

        @if ($canSubscribe ?? false)
            <div class="p-gd6 bor-kyc warning-voa border-6a9 bw--bik mb-m36 text-m1o font-weight-s3h">
                <p class="mb-2 small">{{ __('app.event_subscribe_active_membership_hint') }}</p>
                @if ($event->isForMembersOnly())
                    <p class="mb-2 small">{{ __('app.event_subscribe_members_only_hint') }}</p>
                @else
                    <p class="mb-2 small">{{ __('app.event_subscribe_public_hint') }}</p>
                @endif
                {{ __('app.subscribe_to_service') }}
                <form action="{{ route('events.subscribe', $event->id) }}" method="POST" style="display: inline;">
                    @csrf
                    <input type="hidden" name="type" value="event">
                    <button type="submit" class="text-7zo" style="font-size: 16px; font-weight: bold; color: #b68a35 !important; border: none; background: none; font-family: 'Cairo', sans-serif;">
                        {{ __('app.click_here') }}
                    </button>
                </form>
            </div>
        @elseif (! ($userSubscription && $userSubscription->isOpenSubscription()) && ($subscribeBlockReason ?? null))
            <div class="alert alert-warning" role="alert">
                {{ __('app.event_subscribe_blocked_'.$subscribeBlockReason) }}
                @if ($subscribeBlockReason === 'membership_inactive' && auth()->user()->memberApplication)
                    <p class="mb-0 mt-2 small">
                        {{ __('app.subscription_status') }}:
                        <span class="badge {{ auth()->user()->membership_status_badge_class }}">
                            {{ auth()->user()->membership_status_text }}
                        </span>
                    </p>
                @endif
                @if (in_array($subscribeBlockReason, ['members_only_audience', 'membership_required', 'membership_inactive', 'member_role_required'], true))
                    <div class="mt-2">
                        <a href="{{ route('members.register') }}">{{ __('app.create_new_account') }}</a>
                    </div>
                @endif
            </div>
        @endif
    @endauth
</div>

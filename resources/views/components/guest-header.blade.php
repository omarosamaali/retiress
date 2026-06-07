<style>
    #submit::after {
        content: none
    }

</style>
<div style="z-index: 99; position: fixed; top: 0px; width: 100%; background: linear-gradient(to bottom, rgb(184, 216, 234) 3%, rgba(204, 236, 255, 1) 37%, rgba(226, 244, 255, 0.95) 49%, rgba(240, 249, 255, 0.93) 65%, rgb(255, 255, 255) 91%);" id="header">
    <div id="headerholder">
        <div class="fixedheader" id="fixedh">
            <div class="logo">
                <a href="{{ url('/') }}"><img src="{{ asset('assets/images/new-logo.png') }}" /></a>
            </div>

            <div id="dl-menu" class="dl-menuwrapper">
                <button class="dl-trigger">
                    {{ __('app.menu') }}
                </button>
                <ul class="dl-menu">
                    <li class="menutitle">
                        <p style="color: white;">{{ __('app.menu') }}</p>
                    </li>
                    <li>
                        <a href="{{ url('/') }}">{{ __('app.home') }}</a>
                    </li>

                    <li>
                        <a href="#">{{ __('app.about') }}</a>
                        <ul class="dl-submenu">
                            <li>
                                <a href="{{ route('members.about') }}">{{ __('app.about_us') }}</a>
                            </li>
                              <li>
                                  <a href="{{ route('faq') }}">{{ __('app.faq') }}</a>
                              </li>

                            <li>
                                <a href="{{ route('members.leader') }}">{{ __('app.leader_message') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('members.members-list') }}">{{ __('app.board_members') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('members.vision') }}">{{ __('app.vision_mission') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('members.vision2') }}">{{ __('app.goals_values') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('members.committees') }}">{{ __('app.committees') }}</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{ route('events.all-events') }}">{{ __('app.programs_events') }}</a>
                    </li>

                    <li>
                        <a href="#">{{ __('app.media_center') }}</a>
                        <ul class="dl-submenu">
                            <li>
                                <a href="{{ route('news.all-news') }}">{{ __('app.association_news') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('magazines.all-magazines') }}">{{ __('app.retiree_pulse_magazine') }}</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#">{{ __('app.services') }}</a>
                        <ul class="dl-submenu">
                            <li>
                                <a href="{{ route('services.show', ['id'=>1]) }}">{{ __('app.esaad_card') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('services.show', ['id'=>2]) }}">{{ __('app.zakat_fund') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('services.show', ['id'=>3]) }}">{{ __('app.volunteering') }}</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{ route('members.membership') }}">{{ __('app.membership') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('magazines.feature') }}">{{ __('app.مميزات العضوية') }}</a>
                    </li>

                    <li>
                        @auth
                            <a href="{{ Auth::user()->isStaff() ? route('admin.chat') : route('chat') }}">{{ __('app.contact_us') }}</a>
                        @else
                            <a href="{{ route('members.login') }}">{{ __('app.contact_us') }}</a>
                        @endauth
                    </li>

                    @auth
                    <form action="{{ route('members.logout') }}" method="POST" style="margin-top: 1rem;">
                        @csrf
                        <button id="submit" style="margin: unset !important; padding-right: 17px;" type="submit">
                            <i style="padding-left: 5px;" class="fa-solid fa-arrow-right-from-bracket"></i>{{ __('app.logout') }}
                        </button>
                    </form>
                    @endauth

                    <div class="app">
                        <span>{{ __('app.download_app') }}</span><br />
                        <a href="{{ $settings?->android_url }}" class="container-btns-sidebar">Android
                            <img style="height: 27px;" src="{{ asset('assets/images/app.png') }}" alt="">
                        </a>
                        <a href="{{ $settings?->ios_url }}" class="container-btns-sidebar">IOS
                            <img style="height: 27px;" src="{{ asset('assets/images/app.png') }}" alt="">
                        </a>
                    </div>
                    <div class="lang-II mobile-btn">
                        <a class="container-btns-sidebar" href="{{ route('set.locale', app()->getLocale() == 'ar' ? 'en' : 'ar') }}" title="{{ app()->getLocale() == 'ar' ? __('app.switch_to_english') : __('app.switch_to_arabic') }}">
                            <img style="height: 27px;" src="{{ asset('assets/images/en.png') }}" alt="{{ app()->getLocale() == 'ar' ? 'English' : 'العربية' }}">
                            {{ app()->getLocale() == 'ar' ? 'English' : 'عربي' }}
                        </a>
                    </div>
                </ul>
            </div>

            <div class="btns">
                <div class="safespace" style="width:20px;"></div>
                <div class="downapp">
                    @guest
                    <span>
                        <a href="{{ route('members.login') }}">{{ __('app.login') }}</a>
                    </span>
                    @endguest
                </div>
                <div class="lang">
                    <a href="{{ route('set.locale', app()->getLocale() == 'ar' ? 'en' : 'ar') }}" class="lang-toggle" title="{{ app()->getLocale() == 'ar' ? __('app.switch_to_english') : __('app.switch_to_arabic') }}">
                        <img src="{{ asset('assets/images/en.png') }}" alt="{{ app()->getLocale() == 'ar' ? 'English' : 'العربية' }}">
                        {{ app()->getLocale() == 'ar' ? 'English' : 'عربي' }}
                    </a>
                </div>

                @auth
                @php
                    /*
                     * ── Inline member header data ──────────────────────────────────────
                     * كل الحسابات هنا مباشرة بدون اعتماد على View Composer.
                     * لو أي حاجة بوظت، الـ catch يرجع قيم آمنة والهيدر يفضل شغال.
                     */
                    $__hUser         = \Illuminate\Support\Facades\Auth::user();
                    $__hIsMember     = false;
                    $__hCard         = [];
                    $__hCardStatus   = 'pending';
                    $__hShowRenewal  = false;
                    $__hDaysLeft     = null;
                    $__hShowDays     = false;
                    $__hExpDate      = null;
                    $__hExpKey       = 'active';
                    try {
                        $__hIsMember = (bool) $__hUser?->isMemberRole();
                        if ($__hIsMember) {
                            $__hApp         = $__hUser->memberApplication;
                            $__hCard        = $__hApp?->toMembershipCardPayload() ?? [];
                            $__hSt          = $__hApp?->membershipDisplayStatus() ?? [];
                            $__hCardStatus  = $__hCard['status']['key'] ?? 'pending';
                            $__hShowRenewal = in_array($__hCardStatus, ['expiring', 'expired']);
                            $__hDaysLeft    = $__hCard['status']['days_left'] ?? null;
                            $__hShowDays    = $__hDaysLeft !== null && in_array($__hCardStatus, ['active', 'expiring']);
                            if (!empty($__hApp?->expiration_date) && ($__hSt['key'] ?? '') !== 'expired') {
                                $__hExpDate = \Carbon\Carbon::parse($__hApp->expiration_date)->format('Y/m/d');
                                $__hExpKey  = $__hSt['key'] ?? 'active';
                            }
                        }
                    } catch (\Throwable $__hErr) { /* safe defaults already set above */ }
                    // notification count: from Composer if available, else 0
                    $__hNotifCount = $headerNotificationCount ?? 0;
                @endphp

                <div class="member-header-welcome d-flex align-items-center flex-wrap gap-1">

                    @if ($__hIsMember)
                    <div class="member-header-tools d-flex align-items-center gap-2 flex-wrap" style="margin-right: 12px;">
                        <div class="downapp">
                            <button type="button" class="member-card-trigger" id="openMembershipCard"
                                title="{{ __('app.membership_card') }}" aria-label="{{ __('app.membership_card') }}">
                                <i class="fa-solid fa-id-card"></i> {{ __('app.my_card') }}
                            </button>
                        </div>
                        <a href="{{ route('members.panel') }}" class="member-panel-link" style="gap: 5px !important;">
                            <i class="fa-solid fa-table-cells-large"></i> {{ __('app.my_panel') }}
                        </a>
                        <div class="member-notifications-wrap">
                            <button style="padding: 3px 8px; gap: 5px !important;" type="button"
                                class="member-notifications-btn" id="toggleMemberNotifications"
                                aria-expanded="false" aria-label="{{ __('app.notifications') }}">
                                <i class="fa-solid fa-bell"></i> {{ __('app.notifications') }}
                                @if ($__hNotifCount > 0)
                                    <span class="member-notifications-badge">{{ $__hNotifCount > 99 ? '99+' : $__hNotifCount }}</span>
                                @endif
                            </button>
                        </div>
                        @if ($__hShowRenewal)
                        <a href="{{ route('members.my-membership') }}" class="member-renewal-btn">
                            <i class="fa-solid fa-rotate-right"></i> {{ __('app.renewal') }}
                        </a>
                        @endif
                        @if ($__hShowDays)
                        <span class="member-days-left member-days-left--{{ $__hCardStatus }}">
                            <i class="fa-solid fa-clock"></i>
                            {{ __('app.days_left', ['days' => $__hDaysLeft]) }}
                        </span>
                        @endif
                    </div>
                    @elseif (!$__hUser?->isStaff())
                    {{-- مستخدم مسجّل لكن ليس عضواً فعالاً بعد --}}
                    <div style="margin-right: 12px;">
                        <a href="{{ route('members.membership-show') }}"
                            style="display:inline-flex; align-items:center; gap:5px; background:#b5933a; color:#fff; border-radius:6px; padding:4px 12px; font-size:.82rem; font-weight:700; text-decoration:none; transition:background .18s;"
                            onmouseover="this.style.background='#8a6e2a'" onmouseout="this.style.background='#b5933a'">
                            <i class="fa-solid fa-star"></i>
                            {{ __('app.join_membership') }}
                        </a>
                    </div>
                    @endif

                    <span>{{ __('app.welcome') }}.. {{ \Illuminate\Support\Str::limit($__hUser->name, 5, '.') }}</span>

                    @if ($__hExpDate)
                    <span class="header-expiry-badge header-expiry-badge--{{ $__hExpKey }}">
                        <i class="fa-solid fa-clock"></i>
                        تنتهي العضوية {{ $__hExpDate }}
                    </span>
                    @endif

                </div>
                @endauth

            </div>
        </div>
    </div>

    @auth
        @if ($__hIsMember)
            @include('components.membership-card-modal', [
                'showMemberHeaderTools' => true,
                'membershipCardPayload' => $__hCard,
            ])
        @endif
        <script src="{{ asset('assets/js/member-header.js') }}" defer></script>
    @endauth
</div>

{{-- Notifications panel: خارج الهيدر تماماً لتجنب overflow:hidden --}}
@auth
@if ($__hIsMember)
<div class="notif-screen" id="memberNotificationsDropdown" hidden aria-hidden="true">
    <div class="notif-screen__backdrop" id="closeMemberNotifications"></div>
    <div class="notif-screen__panel" role="dialog" aria-label="{{ __('app.notifications') }}">
        <div class="notif-screen__head">
            <span class="notif-screen__title">
                <i class="fa-solid fa-bell"></i>
                {{ __('app.notifications') }}
                @if ($__hNotifCount > 0)
                    <span class="notif-screen__count">{{ $__hNotifCount > 99 ? '99+' : $__hNotifCount }}</span>
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
@endif
@endauth

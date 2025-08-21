<style>
    #submit::after {
        content: none
    }

</style>
<div style="overflow: hidden; z-index: 99; position: fixed; top: 0px; width: 100%; background: linear-gradient(to bottom, rgb(184, 216, 234) 3%, rgba(204, 236, 255, 1) 37%, rgba(226, 244, 255, 0.95) 49%, rgba(240, 249, 255, 0.93) 65%, rgb(255, 255, 255) 91%);" id="header">
    <div id="headerholder">
        <div class="fixedheader" id="fixedh">
            <div class="sky">
                <div class="clouds_one"></div>
                <div class="clouds_two"></div>
                <div class="clouds_three"></div>
                <div class="clouds_four"></div>
            </div>
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
                    <li><a href="{{ route('chat') }}">{{ __('app.contact_us') }}</a></li>

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
                    @auth
                    <span>
                        <a href="{{ route('dashboard') }}">{{ __('app.dashboard') }}</a>
                    </span>
                    @endauth
                    <a href="#"><img src="{{ asset('assets/images/apple.png') }}" width="20" height="20" /></a>
                    <a href="#"><img src="{{ asset('assets/images/android.png') }}" width="20" height="20" /></a>
                </div>
                <div class="lang">
                    {{-- الزر ده هيغير اللغة ويعرض اسم اللغة الأخرى --}}
                    <a href="{{ route('set.locale', app()->getLocale() == 'ar' ? 'en' : 'ar') }}" class="lang-toggle" title="{{ app()->getLocale() == 'ar' ? __('app.switch_to_english') : __('app.switch_to_arabic') }}">
                        {{-- الصورة ممكن تكون ثابتة، أو تتغير حسب اللغة الحالية --}}
                        <img src="{{ asset('assets/images/en.png') }}" alt="{{ app()->getLocale() == 'ar' ? 'English' : 'العربية' }}">
                        {{ app()->getLocale() == 'ar' ? 'English' : 'عربي' }}
                    </a>
                </div>
                @auth
                <div> {{ __('app.welcome') }}.. {{ Auth::user()->name }}</div>
                @endauth
            </div>
        </div>
    </div>
    <div class="sky">
        <div class="clouds_one"></div>
        <div class="clouds_two"></div>
        <div class="clouds_three"></div>
        <div class="clouds_four"></div>
    </div>
</div>

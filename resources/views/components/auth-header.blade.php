<style>
    #submit::after {
        content: none
    }
</style>
<div style="overflow: hidden; z-index: 99; position: fixed; top: 0px; width: 100%; background: linear-gradient(to bottom, rgb(184, 216, 234) 3%, rgba(204, 236, 255, 1) 37%, rgba(226, 244, 255, 0.95) 49%, rgba(240, 249, 255, 0.93) 65%, rgb(255, 255, 255) 91%);" id="header">


    <div id="headerholder">

        <div class="fixedheader" id="fixedh">
            <div class="logo">
                <a href="{{ url('/') }}"><img src="{{ asset('assets/images/new-logo.png') }}" /></a>
            </div>

            <div id="dl-menu" class="dl-menuwrapper">
                <button class="dl-trigger">القائمة</button>
                <ul class="dl-menu">
                    <li class="menutitle">
                        <p style="color: white;">القائمة</p>
                    </li>
                    <li>
                        <a href="{{ url('/') }}">الرئيسية</a>
                    </li>

                    <li>
                        <a href="{{ route('members.profile') }}">ملفي الشخصي</a>
                    </li>

                    <li>
                        <a href="{{ route('members.my-membership') }}">عضويتي</a>
                    </li>

                    {{-- <li>
                        <a href="{{ route('members.recordEvents') }}">الإعلانات</a>
                    </li> --}}

                    <li>
                        <a href="{{ route('members.record') }}">سجل المعاملات</a>
                    </li>

                    <li><a href="{{ route('chat') }}">اتصل بنا</a></li>
                    @auth
                    <form action="{{ route('members.logout') }}" method="POST" style="margin-top: 1rem;">
                        @csrf
                        <button id="submit" style="margin: unset !important; padding-right: 17px;" type="submit"><i style="padding-left:
                        5px;" class="fa-solid fa-arrow-right-from-bracket"></i>تسجيل الخروج</button>
                    </form>
                    @endauth

                    <div class="lang-II mobile-btn"><a class="container-btns-sidebar" href="index-En.html">
                            English
                            <img style="height: 27px;" src="{{ asset('assets/images/en.png') }}" alt="">
                        </a></div>
                </ul>
            </div>


            <div class="btns">
                <div class="safespace" style="width:20px;"></div>
                <div class="downapp">
                    @guest
                    <span>
                        <a href="{{ route('member.login') }}">تسجيل الدخول</a>
                    </span>
                    @endguest
                    @auth
                    <span>
                        <a href="{{ route('/') }}">الموقع الرئيسي</a>
                    </span>
                    @endauth
                </div>
                <div class="lang">
                    <a href="index-en.html">
                        English
                        <img src="{{ asset('assets/images/en.png') }}" alt="">
                    </a>
                </div>
                @auth
                <div class="member-header-welcome d-flex align-items-center flex-wrap gap-1">
                    @include('components.member-header-tools')
                    <span>{{ __('app.welcome') }}.. {{ Auth::user()->name }}</span>
                </div>
                @endauth

            </div>
        </div>
    </div>
    @auth
        @include('components.membership-card-modal')
        <script src="{{ asset('assets/js/member-header.js') }}" defer></script>
    @endauth
</div>

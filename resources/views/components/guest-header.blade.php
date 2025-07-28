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
                <button class="dl-trigger">القائمة</button>
                <ul class="dl-menu">
                    <li class="menutitle">
                        <p style="color: white;">القائمة</p>
                    </li>
                    <li>
                        <a href="{{ url('/') }}">الرئيسية</a>
                    </li>

                    <li>
                        <a href="#">عن الجمعية</a>
                        <ul class="dl-submenu">
                            <li>
                                <a href="{{ route('members.about') }}">من نحن</a>
                            </li>
                            <li>
                                <a href="{{ route('members.leader') }}">رسالة رئيس مجلس الإدارة</a>
                            </li>
                            <li>
                                <a href="{{ route('members.members-list') }}">أعضاء مجلس الإدارة</a>
                            </li>
                            <li>
                                <a href="{{ route('members.vision') }}">الرؤية والرساله</a>
                            </li>
                            <li>
                                <a href="{{ route('members.vision2') }}">الأهداف والقيم</a>
                            </li>
                            <li>
                                <a href="{{ route('members.committees') }}">اللجان والمجالس</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{ route('events.all-events') }}">البرامج والفعاليات</a>
                    </li>

                    <li>
                        <a href="#">المركز الاعلامي</a>
                        <ul class="dl-submenu">
                            <li>
                                <a href="{{ route('news.all-news') }}">أخبار الجمعية</a>
                            </li>
                            <li>
                                <a href="{{ route('magazines.all-magazines') }}"> مجلة نبض المتقاعد</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#">الخدمات</a>
                        <ul class="dl-submenu">
                            <li>
                                <a href="{{ route('services.show', ['id'=>1]) }}">بطاقة اسعاد</a>
                            </li>
                            <li>
                                <a href="{{ route('services.show', ['id'=>2]) }}">صندوق الزكاة</a>
                            </li>
                            <li>
                                <a href="{{ route('services.show', ['id'=>3]) }}">التطوع</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{ route('members.membership') }}">العضوية</a>
                    </li>
                    <li><a href="{{ route('chat') }}">اتصل بنا</a></li>

                    @auth
                    <form action="{{ route('members.logout') }}" method="POST" style="margin-top: 1rem;">
                        @csrf
                        <button id="submit" style="margin: unset !important; padding-right: 17px;" type="submit"><i style="padding-left:
                        5px;" class="fa-solid fa-arrow-right-from-bracket"></i>تسجيل الخروج</button>
                    </form> 
                    @endauth

                    <div class="app">
                        <span>تحميل التطبيق</span><br />
                        <a href="#" class="container-btns-sidebar">Android
                            <img style="height: 27px;" src="{{ asset('assets/images/app.png') }}" alt="">
                        </a>
                        <a href="#" class="container-btns-sidebar" href="index-En.html">IOS
                            <img style="height: 27px;" src="{{ asset('assets/images/app.png') }}" alt="">
                        </a>
                    </div>
                    <div class="lang-II mobile-btn"><a class="container-btns-sidebar" href="index-En.html">
                            English
                            <img style="height: 27px;" src="{{ asset('assets/images/en.png') }}" alt="">
                        </a>
                    </div>
                </ul>
            </div>

            <div class="btns">
                <div class="safespace" style="width:20px;"></div>
                <div class="downapp">
                    @guest
                    <span>
                        <a href="{{ route('members.login') }}">تسجيل الدخول</a>
                    </span>
                    @endguest
                    @auth
                    <span>
                        <a href="{{ route('dashboard') }}">لوحة التحكم</a>
                    </span>
                    @endauth
                    <a href="#"><img src="{{ asset('assets/images/apple.png') }}" width="20" height="20" /></a> <a href="#">
                        <img src="{{ asset('assets/images/android.png') }}" width="20" height="20" /></a>
                </div>
                <div class="lang">
                    <a href="index-en.html">
                        English
                        <img src="{{ asset('assets/images/en.png') }}" alt="">
                    </a>
                </div>
                @auth
                <div> مرحبا.. {{ Auth::user()->name }}</div>
                @endauth

            </div>
        </div>
    </div>
    <!--START CLOUDS -->
    <div class="sky">
        <div class="clouds_one"></div>
        <div class="clouds_two"></div>
        <div class="clouds_three"></div>
        <div class="clouds_four"></div>
    </div>
    <!--END CLOUDS -->
</div>

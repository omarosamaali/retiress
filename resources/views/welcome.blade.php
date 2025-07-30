<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/png" href="images/fav.png" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1;" />
    <title>جمعية الإمارات للمتقاعدين</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/other-devices.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/styleU.css') }}" />
    <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/amazingcarousel.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/amazingslider-1.css') }}">
    <script src="{{ asset('assets/js/initcarousel-1.js') }}"></script>
    <script src="{{ asset('assets/js/amazingslider.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/amazingslider-2.css') }}">
    <script src="{{ asset('assets/js/initslider-2.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset(path: 'assets/css/custom.css') }}">
    <style>
        .mobile-btn {
            display: none;
        }

        @media (max-width: 768px) {
            .mobile-btn {
                display: block;
            }
        }

        @media (max-width: 500px) {
            .dl-menuwrapper button {
                margin: 41px 78px 0 0px !important;
            }
        }

    </style>
</head>

<body ng-app="myApp">
    <div id="headerholdert">
        <img src="{{ Storage::url($banner->image) }}" alt="Header Background" style="width:100%; height:100%; object-fit:cover;">
    </div>
    <x-guest-header></x-guest-header>

    {{-- <div id="rotator">
        <div id="amazingcarousel-container-1">
            <div id="amazingcarousel-1" style="display:block;position:relative;margin:0px auto 0px;">
                <div class="amazingcarousel-list-container">
                    <ul class="amazingcarousel-list">
                        <li class="amazingcarousel-item">
                            <div class="amazingcarousel-item-container">
                                <div class="amazingcarousel-text">
                                    <blockquote>التربية الصحيحة هي الحصن الحصين ضد الأفكار الهدامة
                                        والجماعات
                                        الضالة التي تهدم المجتمعات، وصلاح الأمم لا يكون إلا بصلاح الأسرة
                                        والرجوع
                                        إليها</blockquote>
                                </div>
                                <div class="amazingcarousel-image"><img src="{{ asset('assets/images/arrowup.png') }}" alt="عنوان" />
    </div>
    </div>
    </li>
    <li class="amazingcarousel-item">
        <div class="amazingcarousel-item-container">
            <div class="amazingcarousel-text">
                <blockquote>تأتي أهمية بناء الإنسان قبل بناء المرافق الثقافية
                    المختلفة، حيث
                    به تنهض الأمم والحضارات فهو من يثري المعرفة ويعمر
                    الأرض</blockquote>
            </div>
            <div class="amazingcarousel-image"><img src="{{ asset('assets/images/arrowdown.png') }}" alt="عنوان" /></div>
        </div>
    </li>

    </ul>
    <div class="amazingcarousel-prev"></div>
    <div class="amazingcarousel-next"></div>
    </div>

    </div>
    </div>
    </div> --}}

<div id="latest-news" style="margin-bottom: 16px !important; margin-top: 100px !important; display: flex; align-items: center; max-width: 1200px; width: 100%;
    margin: auto; justify-content: space-between;">
    <h3 style="text-align: center; font-size: 36px;">{{ __('app.latest_news') }}</h3>
    <div class="c-morebtn">
        <a href="{{ route("news.all-news") }}" class="main-btn" style="background-color: black;">{{ __('app.more_news') }}</a>
    </div>
</div>
<div style="max-width: 1200px; margin: auto;" class="list-l88 list-vja">
    @foreach($news as $singleNews)
    <a href="{{ url('/news/show/' . $singleNews->id) }}" style="border-radius: 13px !important;" class="list-2nx">
        <span class="image-dvm">
            {{-- هنا بنستخدم الـ title الخاص باللغة الحالية --}}
            <img width="688" height="1024" src="{{ asset('storage/' . $singleNews->main_image) }}" alt="{{ app()->getLocale() == 'ar' ? $singleNews->title_ar : $singleNews->title_en }}">
        </span>
        <span class="list-o16 hqqhi">
            <span class="list-m72">{{ \Carbon\Carbon::parse($singleNews->created_at)->day }}</span>
            <span>{{ \Carbon\Carbon::parse($singleNews->created_at)->translatedFormat('F') }}</span>
        </span>
        <span class="list-zkk">
            <span class="title-n5f qhngb">
                {{ app()->getLocale() == 'ar' ? $singleNews->title_ar : $singleNews->title_en }}
            </span>
            <span class="list-mzq">
                <p>{{ \Illuminate\Support\Str::limit(app()->getLocale() == 'ar' ? $singleNews->description_ar : $singleNews->description_en, 200) }}</p>
            </span>
        </span>
    </a>
    @endforeach
</div>
<section style="background: #016330; margin-top: 100px;">
    <div class="container-e3z">
        <div class="row-sy7">
            <div class="col-w5q">
                <h1 class="font-weight-5zk text-jli" style="margin-top: 25px;">{{ __('app.latest_events') }}</h1>
                <p class="text-jli">{{ __('app.events_description') }}</p>
            </div>
            <div class="col-bpd">
                <div class="swiper eventsSwiper">
                    <div class="swiper-wrapper">
                        @foreach ($events as $event)
                        <div class="swiper-slide">
                            <a href="{{ url('/events/show/' . $event->id) }}" class="slide-content">
                                {{-- هنا بنستخدم الـ title الخاص باللغة الحالية --}}
                                <img src="{{ asset('storage/' . $event->main_image) }}" alt="{{ app()->getLocale() == 'ar' ? $event->title_ar : $event->title_en }}" class="slide-image">
                                <div class="slide-title">
                                    {{-- هنا بنستخدم الـ title الخاص باللغة الحالية --}}
                                    {{ app()->getLocale() == 'ar' ? $event->title_ar : $event->title_en }}
                                </div>
                                <p style="padding-top: 20px; padding-right: 20px; margin-bottom: 15px;">{{ __('app.date') }} : {{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d F Y') }}</p>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
                <a href="{{ route('events.all-events') }}" class="btn-dwo block-qlo" style="display: block; text-align: center; margin-top: 30px;">
                    <i class="fas fa-eye"></i>
                    <span>{{ __('app.view_more') }}</span>
                </a>
            </div>
        </div>
    </div>
</section>

    <x-events-section :services="$services"></x-events-section>
    <x-latest-section :magazines="$magazines"></x-latest-section>
    <x-footer-section></x-footer-section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets/js/scriptU.js') }}"></script>
</body>

</html>
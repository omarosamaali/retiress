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
        .quoteSwiper {
            position: absolute;
            top: 73%;
            left: 75%;

            transform: translate(-50%, -50%);
            width: 100%;
            max-width: 420px;
            height: 220px;

            padding: 20px;
            /* background: rgba(255, 255, 255, 0.85); */
            /* Semi-transparent white background */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 10;
        }

        .quote-slide {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            text-align: right;
            /* Right-aligned text for Arabic */
            direction: rtl;
            /* Ensure RTL for Arabic content */
        }

        .quote-text {
            flex: 1;
            padding-left: 15px;
        }

        .quote-text blockquote {
            font-size: 16px;
            /* Slightly smaller font for better fit */
            line-height: 1.5;
            color: #333;
            margin: 0;
            padding: 10px;
            border-right: 4px solid #704e40;
            /* Green accent */
        }

        .quote-image img {
            max-width: 80px;
            /* Smaller image size */
            height: auto;
            object-fit: contain;
        }

        .swiper-button-prev,
        .swiper-button-next {
            color: #704e40;
            /* Green color */
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .swiper-button-prev:after,
        .swiper-button-next:after {
            font-size: 18px;
        }

        .swiper-pagination-bullet {
            background: #704e40;
            opacity: 0.5;
        }

        .swiper-pagination-bullet-active {
            opacity: 1;
            background: #704e40;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .quoteSwiper {
                max-width: 90%;
                /* Slightly narrower on mobile */
                padding: 15px;
            }

            .quote-slide {
                flex-direction: column;
                text-align: center;
            }

            .quote-text {
                padding-left: 0;
                margin-bottom: 15px;
            }

            .quote-text blockquote {
                font-size: 14px;
                /* Smaller font on mobile */
            }

            .quote-image img {
                max-width: 60px;
                /* Smaller image on mobile */
            }

            .swiper-button-prev,
            .swiper-button-next {
                width: 30px;
                height: 30px;
            }

            .swiper-button-prev:after,
            .swiper-button-next:after {
                font-size: 16px;
            }
        }

        /* تأثير السحاب الخفيف */

        .floating-clouds {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            pointer-events: none;
            z-index: 1000;
            overflow: hidden;
        }

        .cloud {
            position: absolute;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.3), rgba(230, 230, 255, 0.2), rgba(255, 255, 255, 0.1));
            border-radius: 50px;
            opacity: 0.8;
            animation: float-cloud linear infinite;
            will-change: transform;
            filter: blur(1px);
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
        }

        .cloud:before {
            content: '';
            position: absolute;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.4), rgba(240, 240, 255, 0.3), rgba(255, 255, 255, 0.2));
            border-radius: 60px;
            filter: blur(2px);
        }

        .cloud:after {
            content: '';
            position: absolute;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(250, 250, 255, 0.1), rgba(255, 255, 255, 0.3));
            border-radius: 40px;
            filter: blur(1.5px);
        }

        .cloud1 {
            width: 120px;
            height: 60px;
            top: 10%;
            animation-duration: 25s;
            animation-delay: 0s;
        }

        .cloud1:before {
            width: 80px;
            height: 80px;
            top: -40px;
            left: 20px;
        }

        .cloud1:after {
            width: 100px;
            height: 60px;
            top: -25px;
            left: 50px;
        }

        .cloud2 {
            width: 90px;
            height: 45px;
            top: 25%;
            animation-duration: 30s;
            animation-delay: -8s;
        }

        .cloud2:before {
            width: 60px;
            height: 60px;
            top: -30px;
            left: 15px;
        }

        .cloud2:after {
            width: 75px;
            height: 45px;
            top: -15px;
            left: 35px;
        }

        .cloud3 {
            width: 150px;
            height: 75px;
            top: 45%;
            animation-duration: 35s;
            animation-delay: -15s;
        }

        .cloud3:before {
            width: 100px;
            height: 100px;
            top: -50px;
            left: 25px;
        }

        .cloud3:after {
            width: 125px;
            height: 75px;
            top: -30px;
            left: 60px;
        }

        .cloud4 {
            width: 110px;
            height: 55px;
            top: 65%;
            animation-duration: 28s;
            animation-delay: -22s;
        }

        .cloud4:before {
            width: 70px;
            height: 70px;
            top: -35px;
            left: 18px;
        }

        .cloud4:after {
            width: 90px;
            height: 55px;
            top: -20px;
            left: 45px;
        }

        .cloud5 {
            width: 130px;
            height: 65px;
            top: 80%;
            animation-duration: 32s;
            animation-delay: -30s;
        }

        .cloud5:before {
            width: 85px;
            height: 85px;
            top: -42px;
            left: 22px;
        }

        .cloud5:after {
            width: 105px;
            height: 65px;
            top: -25px;
            left: 55px;
        }

        @keyframes float-cloud {
            0% {
                transform: translateX(-200px) translateY(0px);
                opacity: 0;
            }

            10% {
                opacity: 0.8;
            }

            90% {
                opacity: 0.8;
            }

            100% {
                transform: translateX(calc(100vw + 200px)) translateY(-10px);
                opacity: 0;
            }
        }

        /* تأثير خفيف للسحاب في الموبايل */
        @media (max-width: 768px) {
            .floating-clouds {
                width: 100vw;
                height: 100vh;
            }

            .cloud1,
            .cloud2,
            .cloud3,
            .cloud4,
            .cloud5 {
                transform: scale(0.7);
            }
        }

        .swiper-slide {
            background: #cfa046c7 !important;
        }

    </style>
</head>

<body ng-app="myApp">
    <!-- السحاب الخفيف في أعلى الصفحة -->
    <div class="floating-clouds">
        <div class="cloud cloud1"></div>
        <div class="cloud cloud2"></div>
        <div class="cloud cloud3"></div>
        <div class="cloud cloud4"></div>
        <div class="cloud cloud5"></div>
        <div class="cloud cloud1" style="animation-delay: -40s;"></div>
        <div class="cloud cloud2" style="animation-delay: -45s;"></div>
        <div class="cloud cloud3" style="animation-delay: -50s;"></div>
    </div>

    <div id="headerholdert" style="position: relative; width: 100%; height: 82vh; overflow: hidden;     margin-top: 145px;">
        <img src="{{ Storage::url($banner->image) }}" alt="Header Background" style="width: 100%; height: 100%; object-fit: fill;">
        <div class="swiper quoteSwiper">
            <div class="swiper-wrapper">
                @foreach (\App\Models\Slider::where('is_active', true)->get() as $slider)
                <div class="swiper-slide">
                    <div class="quote-slide">
                        <div class="quote-text">
                            <blockquote style="color: white;">
                                {{ $slider->quote_ar }}
                            </blockquote>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>


    <x-guest-header></x-guest-header>


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
    <section style="background: #704e40; margin-top: 100px;">
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
<script>
    var quoteSwiper = new Swiper('.quoteSwiper', {
        slidesPerView: 1
        , spaceBetween: 20
        , loop: true
        , autoplay: {
            delay: 5000
            , disableOnInteraction: false
        , }
        , pagination: {
            el: '.swiper-pagination'
            , clickable: true
        , }
        , navigation: {
            nextEl: '.swiper-button-next'
            , prevEl: '.swiper-button-prev'
        , }
    , });

</script>


</html>

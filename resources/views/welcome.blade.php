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
    <link rel="icon" href="http://127.0.0.1:8000/assets/img/Group.png" type="image/x-icon">

    <style>
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

    <div id="headerholdert"
        style="position: relative; width: 100%; height: 82vh; overflow: hidden;     margin-top: 145px;">
        <img src="{{ Storage::url($banner?->image) }}" alt="Header Background"
            style="width: 100%; height: 100%; object-fit: fill;">
        <div class="swiper quoteSwiper">
            <div class="swiper-wrapper">
                @foreach (\App\Models\Slider::where('is_active', true)->get() as $slider)
                <div class="swiper-slide">
                    <div class="quote-slide">
                        <div class="quote-icon">
                            <i class="fas fa-quote-right"></i>
                        </div>
                        <div class="quote-text">
                            <blockquote>
                                {{ $slider->quote_ar }}
                            </blockquote>
                        </div>
                        <div class="quote-decoration"></div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>

        <style>
            .quoteSwiper {
                position: absolute;
                top: 73%;
                left: 75%;
                transform: translate(-50%, -50%);
                width: 100%;
                max-width: 480px;
                height: auto;
                min-height: 250px;
                padding: 0;
                border-radius: 20px;
                box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
                z-index: 10;
                overflow: hidden;
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }

            .quote-slide {
                position: relative;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: 35px 30px;
                text-align: center;
                direction: rtl;
                min-height: 250px;
                overflow: hidden;
            }

            .quote-slide::before {
                content: '';
                position: absolute;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
                background-size: 30px 30px;
                animation: float 20s linear infinite;
                opacity: 0.3;
            }

            @keyframes float {
                0% {
                    transform: translate(-50%, -50%) rotate(0deg);
                }

                100% {
                    transform: translate(-50%, -50%) rotate(360deg);
                }
            }

            .quote-icon {
                position: absolute;
                top: 20px;
                right: 25px;
                font-size: 2.5rem;
                color: rgba(255, 255, 255, 0.2);
                z-index: 1;
            }

            .quote-text {
                flex: 1;
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 2;
            }

            .quote-text blockquote {
                font-size: 18px;
                font-weight: 500;
                line-height: 1.7;
                color: #fff;
                margin: 0;
                padding: 0;
                text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
                position: relative;
                font-family: 'Cairo', 'Arial', sans-serif;
                letter-spacing: 0.5px;
            }

            .quote-decoration {
                position: absolute;
                bottom: 20px;
                left: 50%;
                transform: translateX(-50%);
                width: 60px;
                height: 3px;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.6), transparent);
                border-radius: 2px;
            }

            .swiper-button-prev,
            .swiper-button-next {
                color: transparent !important;
                background: rgba(255, 255, 255, 0.15);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                border-radius: 50%;
                width: 45px !important;
                height: 45px !important;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.3s ease;
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            }

            .swiper-button-prev:hover,
            .swiper-button-next:hover {
                background: rgba(255, 255, 255, 0.25);
                transform: scale(1.1);
                box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
            }

            .swiper-button-prev i,
            .swiper-button-next i {
                color: #fff;
                font-size: 16px;
                text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
            }

            .swiper-button-prev:after,
            .swiper-button-next:after {
                display: none;
            }

            .swiper-pagination {
                bottom: 15px !important;
            }

            .swiper-pagination-bullet {
                background: rgba(255, 255, 255, 0.4) !important;
                opacity: 1 !important;
                width: 10px !important;
                height: 10px !important;
                border-radius: 50% !important;
                transition: all 0.3s ease;
                border: 1px solid rgba(255, 255, 255, 0.2);
            }

            .swiper-pagination-bullet-active {
                background: #fff !important;
                transform: scale(1.3);
                box-shadow: 0 0 15px rgba(255, 255, 255, 0.5);
            }

            /* Responsive Design */
            @media (max-width: 768px) {
                .quoteSwiper {
                    max-width: 90%;
                    min-height: 200px;
                    left: 50%;
                    top: 70%;
                }

                .quote-slide {
                    padding: 25px 20px;
                    min-height: 200px;
                }

                .quote-icon {
                    font-size: 2rem;
                    top: 15px;
                    right: 20px;
                }

                .quote-text blockquote {
                    font-size: 16px;
                    line-height: 1.6;
                }

                .swiper-button-prev,
                .swiper-button-next {
                    width: 38px !important;
                    height: 38px !important;
                }

                .swiper-button-prev i,
                .swiper-button-next i {
                    font-size: 14px;
                }
            }

            @media (max-width: 480px) {
                .quoteSwiper {
                    max-width: 95%;
                    min-height: 180px;
                    top: 68%;
                }

                .quote-slide {
                    padding: 20px 15px;
                    min-height: 180px;
                }

                .quote-text blockquote {
                    font-size: 14px;
                    line-height: 1.5;
                }

                .quote-icon {
                    font-size: 1.8rem;
                    top: 12px;
                    right: 15px;
                }

                .swiper-button-prev,
                .swiper-button-next {
                    width: 35px !important;
                    height: 35px !important;
                }

                .swiper-pagination-bullet {
                    width: 8px !important;
                    height: 8px !important;
                }
            }

            .quote-slide::after {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
                animation: shimmer 3s infinite;
            }

            @keyframes shimmer {
                0% {
                    left: -100%;
                }

                100% {
                    left: 100%;
                }
            }
        </style>
    </div>
    <x-guest-header></x-guest-header>
    <a href="{{ route('magazines.feature') }}" id="reg" style="margin-left: auto;
    margin-right: auto;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 90%;
    max-width: 1200px;
    margin-top: 20px;
    font-size: 23px;
    height: 56px;
    font-weight: bold;" class="btn-qhr btn-primary-t6n">
    <i class="fas fa-star" style="margin-left: 8px;"></i>
        {{ __('app.تفاصيل المميزات') }}
    </a>
    <div id="latest-news"
        style="margin-bottom: 16px !important; margin-top: 100px !important; display: flex; align-items: center; max-width: 1200px; width: 100%; margin: auto; justify-content: space-between;">
        <h3 style="text-align: center; font-size: 36px;">{{ __('app.latest_news') }}</h3>
        <div class="c-morebtn">
            <a href="{{ route("news.all-news") }}" class="main-btn" style="background-color: black;">{{
                __('app.more_news') }}</a>
        </div>
    </div>
    <div style="max-width: 1200px; margin: auto;" class="list-l88 list-vja">
        @foreach($news as $singleNews)
        <a href="{{ url('/news/show/' . $singleNews->id) }}" style="border-radius: 13px !important;" class="list-2nx">
            <span class="image-dvm">
                <img width="688" height="1024" src="{{ Storage::url($singleNews->main_image) }}"
                    alt="{{ app()->getLocale() == 'ar' ? $singleNews->title_ar : $singleNews->title_en }}">
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
                    <p>{{ \Illuminate\Support\Str::limit(app()->getLocale() == 'ar' ? $singleNews->description_ar :
                        $singleNews->description_en, 200) }}</p>
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
                                    <img src="{{ asset('storage/' . $event->main_image) }}"
                                        alt="{{ app()->getLocale() == 'ar' ? $event->title_ar : $event->title_en }}"
                                        class="slide-image">
                                    <div class="slide-title">
                                        {{ app()->getLocale() == 'ar' ? $event->title_ar : $event->title_en }}
                                    </div>
                                    <p style="padding-top: 20px; padding-right: 20px; margin-bottom: 15px;">{{
                                        __('app.date') }} : {{
                                        \Carbon\Carbon::parse($event->event_date)->translatedFormat('d F Y') }}</p>
                                </a>
                            </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-next">
                            <i class="fas fa-chevron-left"></i>
                        </div>
                        <div class="swiper-button-prev">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>
                    <a href="{{ route('events.all-events') }}" class="btn-dwo block-qlo"
                        style="display: block; text-align: center; margin-top: 30px;">
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
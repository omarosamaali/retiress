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
    <link rel="icon" href="http://127.0.0.1:8000/assets/img/Group.png" type="image/x-icon">

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
    <x-auth-header></x-auth-header>

    <div id="latest-news" style="margin-top: 100px !important; display: flex; align-items: center; max-width: 1200px; width: 100%; margin: auto; justify-content: space-between;">
        <h3 style="text-align: center; font-size: 36px; width: 90%;">أحدث
            الأخبار</h3>
        <div class="c-morebtn" style="width: 10%;">
            <a href="{{ route("news.all-news") }}" class="main-btn" style="background-color: black;">المزيد
                من الأخبار</a></div>
    </div>
    <div style="max-width: 1200px; margin: auto;" class="list-l88 list-vja">
        @foreach($news as $singleNews)
        <a href="{{ url('/news/show/' . $singleNews->id) }}" class="list-2nx">
            <span class="image-dvm">
                <img width="688" height="1024" src="{{ asset('storage/' . $singleNews->main_image) }}" alt="{{ $singleNews->title_ar }}">
            </span>
            <span class="list-o16 hqqhi">
                <span class="list-m72">{{ \Carbon\Carbon::parse($singleNews->created_at)->day }}</span>
                <span>{{ \Carbon\Carbon::parse($singleNews->created_at)->translatedFormat('F') }}</span>
            </span>
            <span class="list-zkk">
                <span class="title-n5f qhngb">
                    {{ $singleNews->title_ar }}
                </span>
                <span class="list-mzq">
                    <p>{{ \Illuminate\Support\Str::limit($singleNews->description_ar, 200) }}</p>
                </span>
            </span>
        </a>
        @endforeach
    </div>
    <section style="background: #016330; margin-top: 100px;">
        <div class="container-e3z">
            <div class="row-sy7">
                <div class="col-w5q">
                    <h1 class="font-weight-5zk text-jli" style="margin-top: 25px;">أحدث
                        الفعاليات</h1>
                    <p class="text-jli">برامج وخدمات اجتماعية وتربوية وثقافية منوعة لكافة
                        شرائح المجتمع مع التركيز على
                        فئة
                        الشباب بالتعاون والشراكة مع مختلف الجهات المعنية</p>
                </div>
                <div class="col-bpd">
                    <!-- Swiper -->
                    <div class="swiper eventsSwiper">
                        <div class="swiper-wrapper">
                            @foreach ($events as $event)
                            <div class="swiper-slide">
                                <a href="{{ url('/events/show/' . $event->id) }}" class="slide-content">
                                    <img src="{{ asset('storage/' . $event->main_image) }}" alt="{{ $event->title_ar }}" class="slide-image">
                                    <div class="slide-title">
                                        {{ $event->title_ar }}
                                    </div>
                                    <p style="padding-top: 20px; padding-right: 20px; margin-bottom: 15px;">التاريخ : {{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d F Y') }}</p> {{-- الكود هنا --}}
                                </a>
                            </div>
                            @endforeach
                        </div>
                        <!-- Add Pagination -->
                        <div class="swiper-pagination"></div>
                        <!-- Add Navigation -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                    <a href="{{ route('events.all-events') }}" class="btn-dwo block-qlo" style="display: block; text-align: center; margin-top: 30px;">
                        <i class="fas fa-eye"></i>
                        <span>شاهد المزيد</span>
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
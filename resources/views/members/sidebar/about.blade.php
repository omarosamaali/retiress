<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/fav.png') }}" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1;" />
    <title>من نحن</title>
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
</head>

<body>
    <x-guest-header></x-guest-header>
    <div id="in-cont">
        <div class="inn-title" style="padding-top: 150px">
            <h2><span><a href="{{ url('/') }}">الرئيسية</a> &raquo;</span>
                من نحن
            </h2>
        </div>
        @if($about)
        <div style="padding-top: 50px">
            <div class="container-i1t">
                <div class="row-1yt" style="overflow: hidden !important;">
                    <div class="container-sls col-rrx">
                        <div class="column-wcn">
                            <div>
                                <div class="row-gtg vc_-ppz">
                                    <div class="container-sls col-zbp">
                                        <div class="column-wcn">
                                            <div>
                                                <div class="image-ksy content-zgb vc_-lpq">
                                                    <figure class="vc_-ao4">
                                                        <div class="wrapper-j81">
                                                            <img width="1275" height="743" 
                                                            src="{{ asset('storage/' . $about->main_image) }}" />
                                                        </div>
                                                    </figure>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container-sls col-zbp">
                                        <div class="column-wcn">
                                            <div>
                                                <div class="column-dx4 content-zgb header-f37">
                                                    <div class="flex-container">
                                                        <h1 id="style-Ksnz9" class="style-Ksnz9">
                                                            {{ $about->title_ar }}
                                                        </h1>
                                                    </div>
                                                </div>
                                                <div class="column-dx4 content-zgb">
                                                    <div>
                                                        <p dir="rtl" id="style-DRlzk" class="style-DRlzk">
                                                            {{ $about->description_ar }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div>
            لا توجد تفاصيل عن الجمعية
        </div>
        @endif
    </div>
    <x-footer-section></x-footer-section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets/js/scriptU.js') }}"></script>
    </div>
</body>

</html>

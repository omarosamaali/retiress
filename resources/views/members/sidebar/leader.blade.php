<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/fav.png') }}" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1;" />
    <title>{{ __('app.chairman_message_title') }}</title>

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
        <h2>
            <span><a href="{{ url('/') }}">{{ __('app.home_breadcrumb') }}</a> &raquo;</span>
            {{ __('app.chairman_message_title') }}
        </h2>
    </div>
    @if($about) {{-- Assuming $about variable contains the chairman's message details --}}
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
                                                        {{-- Display alt text based on current locale. Assuming image relates to the message. --}}
                                                        <img width="1275" height="743" src="{{ asset('storage/' . $about->main_image) }}" alt="{{ app()->getLocale() == 'ar' ? ($about->title_ar ?? __('app.chairman_message_title')) : ($about->title_en ?? __('app.chairman_message_title')) }}" />
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
                                                        {{-- Display title based on current locale --}}
                                                        {{ app()->getLocale() == 'ar' ? $about->title_ar : $about->title_en }}
                                                    </h1>
                                                </div>
                                            </div>
                                            <div class="column-dx4 content-zgb">
                                                <div>
                                                    {{-- Adjust text direction and display description based on current locale --}}
                                                    <p dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" id="style-DRlzk" class="style-DRlzk">
                                                        {{ app()->getLocale() == 'ar' ? $about->description_ar : $about->description_en }}
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
        {{-- Display message if no chairman's message is available --}}
        {{ __('app.no_chairman_message') }}
    </div>
    @endif
</div>
<x-footer-section></x-footer-section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets/js/scriptU.js') }}"></script>
    </div>
</body>

</html>
